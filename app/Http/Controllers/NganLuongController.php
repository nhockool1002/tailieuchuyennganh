<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NganLuongController extends Controller
{
    public function postNganluong(Request $request) 
    {
        require_once(app_path() . '/Library/Checkout/config.php');
        require_once(app_path() . '/Library/Checkout/Classes/nganluong.class.php');

        //$ten= $_POST["txt_test"];
        $receiver=RECEIVER;
        //Mã đơn hàng 
        $order_code='NL_'.time();
        //Khai báo url trả về 
        $return_url= $_SERVER['HTTP_REFERER']. "/success.php";
        // Link nut hủy đơn hàng
        $cancel_url= $_SERVER['HTTP_REFERER'];	
        //Giá của cả giỏ hàng 
        $txh_name =$request->txh_name;	
        $txt_email =$request->txt_email;
        $txt_phone =$request->txt_phone; 	
        $price =(int)$request->txt_gia;	
        //Thông tin giao dịch
        $transaction_info="Thong tin giao dich";
        $currency= "vnd";
        $quantity=1;
        $tax=0;
        $discount=0;
        $fee_cal=0;
        $fee_shipping=0;
        $order_description="Thong tin don hang: ".$order_code;
        $buyer_info=$txh_name."*|*".$txt_email."*|*".$txt_phone;
        $affiliate_code="";
        //Khai báo đối tượng của lớp NL_Checkout
        $nl= new \NL_Checkout();
        $nl->nganluong_url = NGANLUONG_URL;
        $nl->merchant_site_code = MERCHANT_ID;
        $nl->secure_pass = MERCHANT_PASS;
        //Tạo link thanh toán đến nganluong.vn
        $url= $nl->buildCheckoutUrlExpand($return_url, $receiver, $transaction_info, $order_code, $price, $currency, $quantity, $tax, $discount , $fee_cal,    $fee_shipping, $order_description, $buyer_info , $affiliate_code);
        //$url= $nl->buildCheckoutUrl($return_url, $receiver, $transaction_info, $order_code, $price);
        
        
        //echo $url; die;
        if ($order_code != "") {
            //một số tham số lưu ý
            //&cancel_url=http://yourdomain.com --> Link bấm nút hủy giao dịch
            //&option_payment=bank_online --> Mặc định forcus vào phương thức Ngân Hàng
            $url .='&cancel_url='. $cancel_url;
            //$url .='&option_payment=bank_online';
            
            echo '<meta http-equiv="refresh" content="0; url='.$url.'" >';
            //&lang=en --> Ngôn ngữ hiển thị google translate
        }
    }
}
