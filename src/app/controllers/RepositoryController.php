<?php

namespace Akuriatadev\Wordit\App\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class RepositoryController extends Controller
{
    private static $upgradeMessages = [];
    private static $upgradeMessageCounter = 0;
    private $timeout = 3600;

    public function index()
    {
        return view('wordit::repository.index');
    }

    public function getRepositories ()
    {
        $dir = dirname(getcwd());
        $info = new Process('cd ' . $dir . ' && composer info');
        $info->setTimeout($this->timeout);
        $info->run();

        // executes after the command finishes
        if (!$info->isSuccessful()) {
            throw new ProcessFailedException($info);
        }

        $outdated = new Process('cd ' . $dir . ' && composer outdated');
        $outdated->setTimeout($this->timeout);
        $outdated->run();

        // executes after the command finishes
        if (!$outdated->isSuccessful()) {
            throw new ProcessFailedException($outdated);
        }

        preg_match_all('/\w\S+.*/', $info->getOutput(), $infos, PREG_SET_ORDER, 0);
        preg_match_all('/\w\S+.*/', $outdated->getOutput(), $outdateds, PREG_SET_ORDER, 0);
        $repositories = collect();

        foreach ($infos as $i) {
            $result = array_slice(explode(" ", preg_replace('!\s+!', ' ', $i[0])), 0, 2);

            foreach ($outdateds as $o) {
                $resulto = array_slice(explode(" ", preg_replace('!\s+!', ' ', $o[0])), 0, 4);

                if ($result[0] == $resulto[0]) {
                    $result[2] = trim($resulto[3]);
                    $result['order'] = 1;
                }
            }
            $repositories->push($result);
        }

        $filtered = $repositories->sortByDesc('order');
        return response()->json([
            'repositories' => $filtered->values()->all(),
            'repositories_count' => $filtered->count()
        ], 200);
    }

    public function upgrade ()
    {
        $dir = dirname(getcwd());
        $upgrade = new Process('cd ' . $dir . ' && composer update');
        $upgrade->run(function ($type, $buffer) {
            if (Process::ERR === $type) {
                if (trim($buffer) != '') {
                    self::$upgradeMessages[self::$upgradeMessageCounter]['type'] = 'Błąd';
                    self::$upgradeMessages[self::$upgradeMessageCounter]['message'] = $buffer;
                }
            } else {
                if (trim($buffer) != '') {
                    self::$upgradeMessages[self::$upgradeMessageCounter]['type'] = 'Info';
                    self::$upgradeMessages[self::$upgradeMessageCounter]['message'] = $buffer;
                }
            }
            self::$upgradeMessageCounter++;
        });
        $upgrade->setTimeout($this->timeout);

        // executes after the command finishes
        if (!$upgrade->isSuccessful()) {
            throw new ProcessFailedException($upgrade);
        }

        $assets = new Process('cd ' . $dir . ' && php artisan vendor:publish --tag=wordit-assets --force');
        $assets->setTimeout($this->timeout);
        $assets->run();

        // executes after the command finishes
        if (!$assets->isSuccessful()) {
            throw new ProcessFailedException($assets);
        }

        return response()->json([
            'outputAssets' => 'Zaktualizowano style panelu zarządzania.',
            'outputUpgrade' => self::$upgradeMessages
        ], 200);
    }
}
