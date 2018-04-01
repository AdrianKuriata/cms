<?php

namespace Akuriatadev\Wordit\Traits;

trait WorditTrait {
    public function label($label)
    {
        return $this->labels[$label];
    }

    public function getRouteName()
    {
        return $this->route_name;
    }

    public function getTableFields()
    {
        return $this->adminTable;
    }
}
