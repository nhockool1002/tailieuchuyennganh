<?php

use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('setting')->insert([
            'config_name' => 'signature',
            'config_setting' => '<p><a href="https://www.facebook.com/groups/kgroupdocument/" target="_blank" rel="noopener"><strong><span style="color: #ff0000;">THAM GIA CỘNG ĐỒNG XSHARE COMMUNITY</span></strong></a></p>
<p><a href="https://tinyurl.com/ya3k29uh"><span style="color: #000080;"><strong>DANH S&Aacute;CH T&Agrave;I NGUY&Ecirc;N MIỄN PH&Iacute; TẠI XSHARE</strong></span></a></p>'
        ]);

        DB::table('setting')->insert([
            'config_name' => 'social',
            'config_setting' => '{"facebook" : "https://facebook.com", "twitter" : "https://twitter.com", "google" : "https://google.com"}'
        ]);

        DB::table('setting')->insert([
            'config_name' => 'backend_credit',
            'config_setting' => '<p><strong><span style="color: #800000;">XShare Comunity</span>&nbsp;&copy; 2018 - 2020 All right reserved</strong></p>'
        ]);

        DB::table('setting')->insert([
            'config_name' => 'backend_bottom_1',
            'config_setting' => '<p><span style="color: #ff0000;"><strong><a style="color: #ff0000; text-decoration: none;" href="https://www.facebook.com/xshare.community">LogBox</a></strong></span></p>'
        ]);

        DB::table('setting')->insert([
            'config_name' => 'backend_bottom_2',
            'config_setting' => '<p><span style="color: #ff6600;"><strong><a style="color: #ff6600; text-decoration: none;" href="https://www.facebook.com/xshare.community">NoteBox</a></strong></span></p>'
        ]);

        DB::table('setting')->insert([
            'config_name' => 'backend_bottom_3',
            'config_setting' => '<p><span style="color: #339966;"><strong><a style="color: #339966;text-decoration:none" href="https://www.facebook.com/xshare.community">FanPage XShare</a></strong></span></p>'
        ]);

        DB::table('setting')->insert([
            'config_name' => 'frontend_footer_column_1',
            'config_setting' => '<div class="footer-custom">
<p><span style="color:#16a085"><strong>​​​​XShare Community</strong></span> - <em><strong>Cộng đồng chia sẻ t&agrave;i nguy&ecirc;n miễn ph&iacute;</strong></em></p>
</div>'
        ]);

        DB::table('setting')->insert([
            'config_name' => 'frontend_footer_column_2',
            'config_setting' => '{"title":"Social","config":"<ul class=\"nav-aside-social\">\r\n\t<li><a href=\"https:\/\/facebook.com\" target=\"_blank\"><i class=\"fa fa-facebook\"><\/i><\/a><\/li>\r\n\t<li><a href=\"https:\/\/twitter.com\" target=\"_blank\"><i class=\"fa fa-twitter\"><\/i><\/a><\/li>\r\n\t<li><a href=\"https:\/\/google.com\" target=\"_blank\"><i class=\"fa fa-google-plus-square\"><\/i><\/a><\/li>\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t\t<\/ul>"}'
        ]);

        DB::table('setting')->insert([
            'config_name' => 'frontend_footer_column_3',
            'config_setting' => '{"title":"Page","config":"<ul>\r\n\t<li><span style=\"font-size:11px\"><a href=\"#\">How to contact ?<\/a><\/span><\/li>\r\n\t<li><span style=\"font-size:11px\"><a href=\"#\">How to request resource ?<\/a><\/span><\/li>\r\n\t<li><span style=\"font-size:11px\"><a href=\"#\">How to join XShare ?<\/a><\/span><\/li>\r\n\t<li><span style=\"font-size:11px\"><a href=\"#3\">How to Download ?<\/a><\/span><\/li>\r\n<\/ul>"}'
        ]);

        DB::table('setting')->insert([
            'config_name' => 'frontend_footer_column_4',
            'config_setting' => '{"title": "Contact","config":"<ul>\r\n<li><a href=\"mailto:xshare.community@gmail.com\">xshare.community@gmail.com<\/a><\/li>\r\n<li><a href=\"mailto:xshare.marketing.1@gmail.com\">xshare.marketing.1@gmail.com<\/a>&nbsp;<\/li>\r\n<\/ul>"}'
        ]);

        DB::table('setting')->insert([
            'config_name' => 'under_construct',
            'config_setting' => '0'
        ]);

        DB::table('setting')->insert([
            'config_name' => 'popup',
            'config_setting' => ''
        ]);
    }
}
