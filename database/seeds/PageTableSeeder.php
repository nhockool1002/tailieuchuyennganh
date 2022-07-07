<?php

use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	DB::table('page')->delete();
        
        factory(App\Page::class)->create([
        	'page_name' => 'How to contact ?',
        	'page_slug' => changeTitle('How to contact ?'),
        	'page_content' => '<p>Bất kỳ l&uacute;c n&agrave;o bạn cần li&ecirc;n lạc với đội ngũ XShare Manager, th&igrave; h&atilde;y nhanh ch&oacute;ng li&ecirc;n lạc với ch&uacute;ng t&ocirc;i qua c&aacute;c Email được ch&uacute;ng t&ocirc;i cung cấp b&ecirc;n dưới đ&acirc;y :</p>

<p>- Để b&aacute;o lỗi trang web, lỗi link tải, bất kỳ nội dung n&agrave;o m&agrave; bạn cần hổ trợ từ đội ngũ của ch&uacute;ng t&ocirc;i, hoặc bạn cần li&ecirc;n hệ đặt quảng c&aacute;o tr&ecirc;n website của ch&uacute;ng t&ocirc;i.</p>

<p><strong>dulieuchuyennganh@gmail.com</strong></p>',
        	'page_img' => 'uF6QQQQ6Fu.png'
        ]);

        factory(App\Page::class)->create([
        	'page_name' => 'How to request resource ?',
        	'page_slug' => changeTitle('How to request resource ?'),
        	'page_content' => '<p>Nếu như bạn đang t&igrave;m kiếm một t&agrave;i nguy&ecirc;n ở lĩnh vực bất kỳ nhưng chưa c&oacute; tại XShare (vui l&ograve;ng t&igrave;m kiếm trước khi chắc chắn n&oacute; kh&ocirc;ng c&oacute;) th&igrave; ch&uacute;ng t&ocirc;i cung cấp cho bạn c&aacute;c giải ph&aacute;p dưới đ&acirc;y để c&oacute; thể gửi cho ch&uacute;ng t&ocirc;i một y&ecirc;u cầu để đội ngủ của ch&uacute;ng t&ocirc;i thực hiện cập nhật cho bạn.</p>

<p><strong>C&aacute;ch 1</strong> : Li&ecirc;n hệ với ch&uacute;ng t&ocirc;i qua Mail, để li&ecirc;n hệ ch&uacute;ng t&ocirc;i qua mail bạn h&atilde;y đọc b&agrave;i viết How to contact ?</p>

<p><strong>C&aacute;ch 2 </strong>: Tham gia group <a href="https://www.facebook.com/groups/kgroupdocument/" target="_blank">Chia sẻ t&agrave;i liệu miễn ph&iacute; - XShare Community</a>&nbsp;, v&agrave; gửi b&agrave;i viết với hashtag đi c&ugrave;ng l&agrave; #XShare_request .</p>

<p><em>V&iacute; dụ </em>: Nhờ Admin t&igrave;m gi&uacute;p em kh&oacute;a học ABC của giảng vi&ecirc;n XYZ ,<strong> #XShare_request</strong></p>

<p><strong>C&aacute;ch 3</strong> : Điền form y&ecirc;u cầu resource, chức năng n&agrave;y hiện nay XShare đang cập nhật nh&eacute; c&aacute;c bạn.</p>',
        	'page_img' => 'psAh22hAsp.png'
        ]);

        factory(App\Page::class)->create([
        	'page_name' => 'How to join XShare ?',
        	'page_slug' => changeTitle('How to join XShare ?'),
        	'page_content' => '<p>Hiện tại XShare Community l&agrave; một trong những cộng đồng chia sẽ t&agrave;i nguy&ecirc;n miễn ph&iacute; c&aacute;c lĩnh vực. Ngo&agrave;i đội ngũ XShare ch&uacute;ng t&ocirc;i sẽ rất vui nếu c&oacute; th&ecirc;m cả sự đ&oacute;ng g&oacute;p của tất cả c&aacute;c bạn cho XShare Community v&agrave; cộng đồng người d&ugrave;ng. Qua đ&oacute; để tham gia v&agrave;o XShare Community chỉ đơn giản như ăn một que kẹo.</p>

<p>Đầu ti&ecirc;n bạn v&agrave;o Facebook, sau đ&oacute; t&igrave;m kiếm &quot;Chia sẻ t&agrave;i liệu miễn ph&iacute; - XShare Community&quot;,&nbsp; bạn sẽ thấy nh&oacute;m XShare Community hiện ra b&ecirc;n dưới, việc c&ograve;n lại l&agrave; nhấn v&agrave;o tham gia th&ocirc;i đ&uacute;ng kh&ocirc;ng n&agrave;o ? C&ograve;n đối với những bạn kh&ocirc;ng muốn t&igrave;m kiếm th&igrave; hay click nhẹ&nbsp;v&agrave;o&nbsp;<a href="https://www.facebook.com/groups/kgroupdocument/">Chia sẻ t&agrave;i liệu miễn ph&iacute; - XShare Community</a>&nbsp;l&agrave; c&oacute; thể tham gia cộng đồng ngay l&acirc;p tức,&nbsp;đội ngũ v&agrave; cộng đồng XShare lu&ocirc;n lu&ocirc;n ch&agrave;o đ&oacute;n th&agrave;nh vi&ecirc;n mới. H&atilde;y c&ugrave;ng tham gia với ch&uacute;ng t&ocirc;i nh&eacute;.</p>',
        	'page_img' => 'fnJLWWLJnf.png'
        ]);

        factory(App\Page::class)->create([
        	'page_name' => 'How to Download ?',
        	'page_slug' => changeTitle('How to Download ?'),
        	'page_content' => '<p>Hiện tại, để duy tr&igrave; cho cộng đồng ph&aacute;t triển cũng như tạo ra kinh ph&iacute; thực hiện c&aacute;c event cho c&aacute;c th&agrave;nh vi&ecirc;n trong cộng đồng như give away, đố vui ... th&igrave; ch&uacute;ng t&ocirc;i thống nhất đặt link r&uacute;t gọn trong c&aacute;c link tải resource tại XShare Community, điều n&agrave;y cũng g&acirc;y ra bất tiện cho người d&ugrave;ng tại website, tuy nhi&ecirc;n ch&uacute;ng t&ocirc;i cam kết kh&ocirc;ng sử dụng quảng c&aacute;o 18+, popup, hoặc l&agrave;m kẹt m&aacute;y. Mong c&aacute;c bạn th&ocirc;ng cảm v&agrave; tiếp tục ủng hộ cho đội ngũ XShare ch&uacute;ng t&ocirc;i.</p>

<p><strong>Hướng dẫn Download&nbsp;</strong></p>

<p><em>- Sau khi v&agrave;o li&ecirc;n kết r&uacute;t gọn, bạn sẽ thấy Captcha của Google, bạn h&atilde;y ho&agrave;n th&agrave;nh n&oacute;</em></p>

<p><em>- Sau khi ho&agrave;n th&agrave;nh, bạn nhấn v&agrave;o n&uacute;t &quot;Click Here to Continue&quot;</em></p>

<p><em>- Sau đ&oacute; m&agrave;n h&igrave;nh sẽ hiện chuyển sang trang&nbsp;countdown khoảng 7s, sau n&oacute; n&uacute;t Getlink hiện l&ecirc;n, bạn chỉ việc click v&agrave;o n&oacute;.</em></p>

<p><em>- Bạn sẽ di chuyển tới trang tải resource được upload l&ecirc;n c&aacute;c host c&oacute; tốc độ nhanh nhất</em></p>',
        	'page_img' => 'QYXd55dXYQ.png'
        ]);
    }
}
