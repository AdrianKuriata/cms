<?php
use App\User;

use Illuminate\Support\Facades\Log;


class Hook {
    public $hooks = [];

    public function addHook($name, $callback)
    {
        return $this->hooks[$name][] = $callback;
    }

    public function doHook($name)
    {
        // Dokończyć IF sprawdzający czy hook istnieje
        if (in_array($this->hooks, $name)) {
            $functions = $this->hooks[$name];
            $data = [];
            foreach ($functions as $method) {
                $data[] = call_user_func($method);
            }

            return $data;
        }
    }
}
global $hooks;
$hooks = new Hook;

function add_hook($name, $callback)
{
    global $hooks;
    return $hooks->addHook($name, $callback);
}

function do_hook($name)
{
    global $hooks;
    return $hooks->doHook($name);
}
