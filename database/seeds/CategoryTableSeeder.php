<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->delete();

    	DB::table('category')->insert([
            'cat_name' => '#Sách',
            'cat_slug' => 'sach',
            'cat_description' => 'Khu vực chia sẻ sách hay cho mọi người.',
            'cat_order' => '1',
        ]);

        DB::table('category')->insert([
            'cat_name' => '#Khóa học',
            'cat_slug' => 'khoa-hoc',
            'cat_description' => 'Khu vực chia sẻ khóa học hay cho mọi người.',
            'cat_order' => '2',
        ]);

        DB::table('category')->insert([
            'cat_name' => '#Ngoại ngữ',
            'cat_slug' => 'ngoai-ngu',
            'cat_description' => 'Khu vực chia sẻ ngoại ngữ cho mọi người.',
            'cat_order' => '3',
        ]);
        DB::table('category')->insert([
            'cat_name' => '#Marketing',
            'cat_slug' => 'marketing',
            'cat_description' => 'Khu vực chia sẻ tài liệu marketing cho mọi người.',
            'cat_order' => '4',
        ]);

        factory(App\Category::class)->create([
    		'cat_name' => '#Phần mềm',
            'cat_slug' => 'phan-mem',
            'cat_description' => 'Khu vực chia sẻ phần mềm cho mọi người.',
            'cat_order' => '5',
    	]);

        factory(App\Category::class)->create([
            'cat_name' => '#Đồ họa',
            'cat_slug' => 'do-hoa',
            'cat_description' => 'Khu vực chia sẻ tài liệu, khóa học, tài nguyên phần mềm cho mọi người.',
            'cat_order' => '6',
        ]);
    }
}
