<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServicePermissionTablerSeeder extends Seeder
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
                'name' => 'Dịch vụ',
                'type' => 'group',
                'key_code' => 'services',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'services',
                'key_code' => Service::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'services',
                'key_code' => Service::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'services',
                'key_code' => Service::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'services',
                'key_code' => Service::DELETE,
            ],
        ];
        \DB::table('permissions')->insert($permissions);
    }
}
