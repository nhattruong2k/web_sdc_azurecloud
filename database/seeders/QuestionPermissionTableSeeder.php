<?php

namespace Database\Seeders;

use App\Models\ActivityLog;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class QuestionPermissionTableSeeder extends Seeder
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
                'name' => 'Q&A',
                'type' => 'group',
                'key_code' => 'questions',
            ],
            [
                'name' => 'Danh sách',
                'type' => 'questions',
                'key_code' => Question::LIST,
            ],
            [
                'name' => 'Thêm mới',
                'type' => 'questions',
                'key_code' => Question::CREATE,
            ],
            [
                'name' => 'Cập nhật',
                'type' => 'questions',
                'key_code' => Question::UPDATE,
            ],
            [
                'name' => 'Xóa',
                'type' => 'questions',
                'key_code' => Question::DELETE,
            ],
        ];
        \DB::table('permissions')->insert($permissions);
    }
}
