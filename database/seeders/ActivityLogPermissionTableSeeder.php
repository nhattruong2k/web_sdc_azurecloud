<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivityLogPermissionTableSeeder extends Seeder
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
                'name' => 'Nhật ký hoạt động',
                'type' => 'group',
                'key_code' => 'activity_logs',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'activity_logs',
                'key_code' => ActivityLog::VIEW,
            ],
            [
                'name' => 'Xóa',
                'type' => 'activity_logs',
                'key_code' => ActivityLog::DELETE,
            ],
        ];
        \DB::table('permissions')->insert($permissions);
    }
}
