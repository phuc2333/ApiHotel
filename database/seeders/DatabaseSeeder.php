<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // $groupId = DB::table('groups')->insertGetId([
        //     'name' => 'Admin',
        //     'user_id' => 0,
        //     'permission' => 'them',
        //     'created_at' => date('Y-m-d H:i:s'),
        //     'updated_at' => date('Y-m-d H:i:s'),
        // ]);
        // DB::statement('SET FOREIGN_KEY_CHECKS = 1');
        // if ($groupId > 0) {
        //     $userId = DB::table('users')->insertGetId([
        //         'name' => 'phuc',
        //         'email' => 'phuc25186@gmail.com',
        //         'password' => Hash::make('12345678'),
        //         'group_id' => $groupId,
        //         'user_id' => 0,
        //         'created_at' => date('Y-m-d H:i:s'),
        //         'updated_at' => date('Y-m-d H:i:s'),
        //     ]);

        //     if ($userId > 0) {
        //         $userId = DB::table('posts')->insertGetId([
        //             'title' => 'lorem abc',
        //             'content' => 'aaaaa',
        //             'user_id' => $userId,
        //         ]);
        //     }
        // }

        DB::table('modules')->insert([
            'name' => 'users',
            'title' => 'Quản lý người dùng',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('modules')->insert([
            'name' => 'groups',
            'title' => 'Quản lý nhóm',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('modules')->insert([
            'name' => 'posts',
            'title' => 'Quản lý bài viết',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
