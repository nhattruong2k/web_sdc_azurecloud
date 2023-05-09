<?php

namespace Database\Seeders;

use App\Models\Work;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkPermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'name' => 'Việc làm',
                'type' => 'group',
                'key_code' => 'work',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'work',
                'key_code' => Work::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'work',
                'key_code' => Work::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'work',
                'key_code' => Work::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'work',
                'key_code' => Work::DELETE,
            ],
        ];
        \DB::table('permissions')->insert($permissions);
    }
}
