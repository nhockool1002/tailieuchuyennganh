<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('post')->delete();
        $lipsum = new joshtronic\LoremIpsum();
        
        factory(App\Post::class)->create([
        	'post_name' => 'Angular 5 cho người mới bắt đầu',
        	'post_slug' => changeTitle('Angular 5 cho người mới bắt đầu'),
        	'post_content' => $lipsum->paragraphs(20),
            'cat_id' => '2',
        	'post_img' => 'demo.png'
        ]);

        factory(App\Post::class)->create([
            'post_name' => 'Học và tìm hiểu ngôn ngữ NodeJS',
            'post_slug' => changeTitle('Học và tìm hiểu ngôn ngữ NodeJS'),
            'post_content' => $lipsum->paragraphs(20),
            'cat_id' => '2',
            'post_img' => 'demo.png'
        ]);

        factory(App\Post::class)->create([
            'post_name' => 'Apachee Spark 2 với Python - Khai thác BigData với PySpark và Spark',
            'post_slug' => changeTitle('Apachee Spark 2 với Python - Khai thác BigData với PySpark và Spark'),
            'post_content' => $lipsum->paragraphs(20),
            'cat_id' => '2',
            'post_img' => 'demo.png'
        ]);

        factory(App\Post::class)->create([
            'post_name' => 'Xây dựng ứng dụng theo mô hình MVC bằng Spring Framework',
            'post_slug' => changeTitle('Xây dựng ứng dụng theo mô hình MVC bằng Spring Framework'),
            'post_content' => $lipsum->paragraphs(20),
            'cat_id' => '2',
            'post_img' => 'demo.png'
        ]);

        factory(App\Post::class)->create([
            'post_name' => 'Học Typescript Async/Await trong NodeJS bằng Testing',
            'post_slug' => changeTitle('Học Typescript Async Await trong NodeJS bằng Testing'),
            'post_content' => $lipsum->paragraphs(20),
            'cat_id' => '2',
            'post_img' => 'demo.png'
        ]);

        factory(App\Post::class)->create([
            'post_name' => 'Sách học Arduino cho người mới bắt đầu',
            'post_slug' => changeTitle('Sách học Arduino cho người mới bắt đầu'),
            'post_content' => $lipsum->paragraphs(20),
            'cat_id' => '1',
            'post_img' => 'demo.png'
        ]);

        factory(App\Post::class)->create([
            'post_name' => '10 bước bắt đầu với Google Adwords bạn phải biết',
            'post_slug' => changeTitle('10 bước bắt đầu với Google Adwords bạn phải biết'),
            'post_content' => $lipsum->paragraphs(20),
            'cat_id' => '4',
            'post_img' => 'demo.png'
        ]);
    }
}
