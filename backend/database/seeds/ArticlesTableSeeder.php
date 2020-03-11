<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 清空数据
        \App\Article::truncate();

        $facker = \Faker\Factory::create();

        for ($i = 0; $i < 50; $i++) {
            \App\Article::create([
                'title' => $facker->sentence,
                'body' => $facker->paragraph,
                'status' => 1,
                'user_id' => 1,
            ]);
        }
    }
}
