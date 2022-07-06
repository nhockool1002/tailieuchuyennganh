<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        if (Schema::hasTable('setting') && Schema::hasTable('page')) {
            if (\App\Setting::where('config_name', 'social')->count() > 0) {
                $sc = \App\Setting::where('config_name', 'social')->first();
                $sc = json_decode($sc->config_setting, true);
                $page = \App\Page::all();
                $page = json_decode($page, true);
                $status = \App\Setting::where('config_name', 'under_construct')->first();
                $status = $status->config_setting;
                $hashtag = \App\HashTag::inRandomOrder()->take(50)->get();
                $settingConfig = [
                    'signature' => \App\Setting::where('config_name','signature')->first(),
                    'backend_credit' => \App\Setting::where('config_name','backend_credit')->first(),
                    'backend_bottom_1' => \App\Setting::where('config_name','backend_bottom_1')->first(),
                    'backend_bottom_2' => \App\Setting::where('config_name','backend_bottom_2')->first(),
                    'backend_bottom_3' => \App\Setting::where('config_name','backend_bottom_3')->first(),
                    'frontend_footer_column_1' => \App\Setting::where('config_name','frontend_footer_column_1')->first(),
                    'frontend_footer_column_2' => \App\Setting::where('config_name','frontend_footer_column_2')->first(),
                    'frontend_footer_column_3' => \App\Setting::where('config_name','frontend_footer_column_3')->first(),
                    'frontend_footer_column_4' => \App\Setting::where('config_name','frontend_footer_column_4')->first(),
                    'sc' => $sc,
                    'pjpage' => $page,
                    'status' => $status,
                    'hashtag' => $hashtag
                ];
                \View::share('settingConfig', $settingConfig);
            }
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
