<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();

        $permission = new Permission();
        $permission->user_id = 1;
        $permission->ledenbeheer = 1;
        $permission->verhuurbeheer = 1;
        $permission->media = 1;
        $permission->cloud = 1;
        $permission->save();
    }
}
