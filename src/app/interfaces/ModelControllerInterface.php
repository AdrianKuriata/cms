<?php

namespace Akuriatadev\Wordit\App\Interfaces;
use Illuminate\Http\Request;

/**
 * This is a required interface for custom controller
 */
interface ModelControllerInterface
{
    public function index();
    public function getCreate();
    public function postCreate();
    public function getUpdate($id, []);
    public function postUpdate($id);
    public function delete($id);
    public function destroy();
}
