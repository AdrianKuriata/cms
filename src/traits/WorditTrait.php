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

    public function getValidationRules()
    {
        return $this->validation;
    }

    public function getController()
    {
        if ($this->controller != null) {
            return $this->controller;
        }

        return false;
    }

    public function getFormFieldsLeft()
    {
        return $this->form['left'];
    }

    public function getFormFieldsRight()
    {
        return $this->form['right'];
    }

    public function getPermissions() {
        return $this->permissions;
    }

    public function getAllPermissionsFillable() {
        $permissions = [
            'view-admin' => 'can_view_admin',
            'view-user' => 'can_view_user',
            'create-user' => 'can_create_user',
            'update-user' => 'can_update_user',
            'delete-user' => 'can_delete_user',
            'view-group' => 'can_view_group',
            'create-group' => 'can_create_group',
            'update-group' => 'can_update_group',
            'delete-group' => 'can_delete_group',
            'view-repository' => 'can_view_repository',
            'create-repository' => 'can_create_repository',
            'update-repository' => 'can_update_repository',
            'delete-repository' => 'can_delete_repository',
        ];

        foreach (config('wordit.models') as $model) {
            $getInstanceModel = new $model;
            if (is_array($getInstanceModel->getPermissions())) {
                $permissions = array_merge($permissions, $getInstanceModel->getPermissions());
            }
        }

        return $permissions;
    }
}
