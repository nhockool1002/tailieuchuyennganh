<?php

use Illuminate\Database\Seeder;

class AdsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ads')->delete();

        factory(App\Ads::class)->create([
            'ads_zone' => 'homepage_rightside_300x250_first'
        ]);

        factory(App\Ads::class)->create([
            'ads_zone' => 'homepage_rightside_300x250_second'
        ]);

        factory(App\Ads::class)->create([
            'ads_zone' => 'bottom_post_728x90',
            'ads_img' => 'https://via.placeholder.com/728x90',
        ]);

        factory(App\Ads::class)->create([
            'ads_zone' => 'bottom_right_widget_post_320x250'
        ]);

        factory(App\Ads::class)->create([
            'ads_zone' => 'category_right_widget_320x250'
        ]);

        factory(App\Ads::class)->create([
            'ads_zone' => 'category_top_content_728x90',
            'ads_img' => 'https://via.placeholder.com/728x90',
        ]);

    }
}
