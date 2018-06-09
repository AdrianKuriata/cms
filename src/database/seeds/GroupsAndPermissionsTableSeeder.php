<?php

use Illuminate\Database\Seeder;
use Akuriatadev\Wordit\App\Models\Group;

class GroupsAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $root = Group::create([
            'name' => 'Root'
        ]);

        $root->permission()->create([
            'can_view_admin' => true,
            'can_view_user' => true,
            'can_create_user' => true,
            'can_update_user' => true,
            'can_delete_user' => true,
            'can_view_group' => true,
            'can_create_group' => true,
            'can_update_group' => true,
            'can_delete_group' => true,
            'can_view_repository' => true,
            'can_create_repository' => true,
            'can_update_repository' => true,
            'can_delete_repository' => true,
        ]);

        $user = Group::create([
            'name' => 'Użytkownik'
        ]);

        $user->permission()->create();
    }
}
