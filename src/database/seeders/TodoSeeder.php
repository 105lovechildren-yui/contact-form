<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Todo;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryIds = Category::pluck('id')->all();

        if (empty($categoryIds)) {
            return;
        }

        $dummyTodos = [
            '資料を作成する',
            'Laravelを復習する',
            '部屋を掃除する',
            '日用品を買う',
            '30分ジョギング',
        ];

        foreach ($dummyTodos as $content) {
            Todo::create([
                'content' => $content,
                'category_id' => Arr::random($categoryIds),
            ]);
        }
    }
}
