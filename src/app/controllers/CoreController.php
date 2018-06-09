<?php

namespace Akuriatadev\Wordit\App\Controllers;

use Carbon\Carbon;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use Symfony\Component\Process\Exception\ProcessFailedException;

class CoreController extends Controller
{
    private $dir, $timeout;
    public function __construct()
    {
        $this->dir = dirname(getcwd());
        $this->timeout = 3000;
    }

    public function checkCore()
    {
        $core = new Process('cd ' . $this->dir . ' && composer -o show laravel/framework | grep "latest"');
        $core->setTimeout($this->timeout);
        $core->run();

        // executes after the command finishes
        if (!$core->isSuccessful()) {
            throw new ProcessFailedException($core);
        }

        preg_match('/:\s(.*)/', $core->getOutput(), $version);

        return response()->json([
            'version' => $version[1]
        ]);
    }

    public function upgradeCore()
    {
        storage_path('logs/upgrading-core.txt');
        // Get outdated packages and format them for using for update
        $outdated = new Process('cd ' . $this->dir . ' && composer outdated -m');

        $outdated->setTimeout($this->timeout);
        $outdated->run();

        // executes after the command finishes
        if (!$outdated->isSuccessful()) {
            throw new ProcessFailedException($outdated);
        }

        preg_match_all('/^\S*/m', $outdated->getOutput(), $outdated, PREG_SET_ORDER, 0);
        $outdated = implode(" ", array_flatten($outdated));

        $outdated = str_replace('akuriatadev/wordit', '', $outdated);

        // Upgrade packages
        $upgrade = new Process('cd ' . $this->dir . ' && composer update ' . $outdated);

        $upgrade->setTimeout($this->timeout);
        $upgrade->run(function ($type, $buffer) {
            if ($buffer) {
                $text = '[' . Carbon::now() . '] [' . $buffer . ']|';
            }

            file_put_contents(storage_path('logs/upgrading-core.txt'), $text, FILE_APPEND | LOCK_EX);
        });

        // executes after the command finishes
        if (!$upgrade->isSuccessful()) {
            throw new ProcessFailedException($upgrade);
        }

        // Remove upgrade files
        sleep(1);
        unlink(storage_path('logs/upgrading-core.txt'));

        return response()->json(200);
    }

    public function upgradeLog()
    {
        if (file_exists(storage_path('logs/upgrading-core.txt'))) {
            $info = explode('|', file_get_contents(storage_path('logs/upgrading-core.txt')));
            $preparedInfo = [];

            foreach ($info as $key => $i) {
                $string = str_replace(PHP_EOL, '', $i);
                preg_match_all('/\[(.*?)\]/s', $string, $matches, PREG_SET_ORDER, 0);

                if (isset($matches[1][1]) && $matches[1][1] != '') {
                    $preparedInfo[$key]['data'] = $matches[0][1];
                    $preparedInfo[$key]['info'] = $matches[1][1];
                }
            }

            return response()->json([
                'prepared' => $preparedInfo,
            ]);
        } else {
            return response()->json(200);
        }
    }
}
