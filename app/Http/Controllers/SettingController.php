<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Setting;
use App\Log;
use App\Category;
use App\SearchData;
use App\RequestHD;
use App\BranchCourse;
use App\DonateListCourse;
use Auth;

class SettingController extends Controller
{
    /**
     * @return view
     */
    public function getIndex() {
    	return view('backend.setting.index');
    }

    /**
     * @return view
     */
    public function getSignScreen() {
    	$data = Setting::where('config_name', 'signature')->first();
    	return view('backend.setting.sign.index', compact('data'));
    }

    /**
     * @param  Request
     * @return view
     */
    public  function postSignature(Request $request) {
    	$config = Setting::where('config_name', 'signature')->first();

    	$config->config_setting = $request->sign;
    	$config->save();

    	$log = new Log();
        $log->changelog = 'Update ' . '<b><font color="#041633">Default Signature</font></b>';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::SETTING_SIGNATURE_FUNCTION;
        $log->save();

        return redirect(route('signature'))->with('success_mesage', 'Update Default Signature successfully.');
    }

    /**
     * @return view
     */
    public function getBackendCreditScreen() {
    	$data = Setting::where('config_name', 'backend_credit')->first();
    	return view('backend.setting.backend-credit.index', compact('data'));
    }

    /**
     * @param  Request
     * @return view
     */
    public  function postBackendCredit(Request $request) {
    	$config = Setting::where('config_name', 'backend_credit')->first();

    	$config->config_setting = $request->credit;
    	$config->save();

    	$log = new Log();
        $log->changelog = 'Update ' . '<b><font color="#190433">Backend Credit</font></b>';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::SETTING_BACKEND_CREDIT_FUNCTION;
        $log->save();

        return redirect(route('backend-credit'))->with('success_mesage', 'Update Backend Credit successfully.');
    }

    /**
     * @return view
     */
    public function getBackendColumnScreen() {
        $col1 = Setting::where('config_name', 'backend_bottom_1')->first();
        $col2 = Setting::where('config_name', 'backend_bottom_2')->first();
        $col3 = Setting::where('config_name', 'backend_bottom_3')->first();
        return view('backend.setting.backend-column.index', compact('col1', 'col2', 'col3'));
    }

    /**
     * @param  Request
     * @return view
     */
    public function postBackendColumn(Request $request) {
        $col1 = Setting::where('config_name', 'backend_bottom_1')->first();
        $col2 = Setting::where('config_name', 'backend_bottom_2')->first();
        $col3 = Setting::where('config_name', 'backend_bottom_3')->first();

        $col1->config_setting = $request->col1;
        $col2->config_setting = $request->col2;
        $col3->config_setting = $request->col3;

        $col1->save();
        $col2->save();
        $col3->save();

        $log = new Log();
        $log->changelog = 'Update ' . '<b><font color="#775e11">Backend Column</font></b>';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::SETTING_BACKEND_COLUMN_FUNCTION;
        $log->save();

        return redirect(route('backend-column'))->with('success_mesage', 'Update Backend Column successfully.');
    }

    
    /**
     * [getFrontendColumnScreen description]
     * @return view
     */
    public function getFrontendColumnScreen() {
        $col1 = Setting::where('config_name', 'frontend_footer_column_1')->first();
        $col2 = Setting::where('config_name', 'frontend_footer_column_2')->first();
        $col3 = Setting::where('config_name', 'frontend_footer_column_3')->first();
        $col4 = Setting::where('config_name', 'frontend_footer_column_4')->first();

        $col2 = json_decode($col2->config_setting, true);
        $col3 = json_decode($col3->config_setting, true);
        $col4 = json_decode($col4->config_setting, true);
        return view('backend.setting.frontend-column.index', compact('col1', 'col2', 'col3', 'col4'));
    }

    public function postFrontendColumn(Request $request) {
        $col1 = Setting::where('config_name', 'frontend_footer_column_1')->first();
        $col2 = Setting::where('config_name', 'frontend_footer_column_2')->first();
        $col3 = Setting::where('config_name', 'frontend_footer_column_3')->first();
        $col4 = Setting::where('config_name', 'frontend_footer_column_4')->first();

        $col1->config_setting = $request->col1;
        $config_col2 = [
            'title' => $request->col2_name,
            'config' => $request->col2_config
        ];
        $config_col3 = [
            'title' => $request->col3_name,
            'config' => $request->col3_config
        ];
        $config_col4 = [
            'title' => $request->col4_name,
            'config' => $request->col4_config
        ];

        $config_col2 = json_encode($config_col2);
        $config_col3 = json_encode($config_col3);
        $config_col4 = json_encode($config_col4);

        $col2->config_setting = $config_col2;
        $col3->config_setting = $config_col3;
        $col4->config_setting = $config_col4;

        $col1->save();
        $col2->save();
        $col3->save();
        $col4->save();

        $log = new Log();
        $log->changelog = 'Update ' . '<b><font color="#42f46b">Frontend Column</font></b>';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::SETTING_FRONTEND_COLUMN_FUNCTION;
        $log->save();

        return redirect(route('frontend-column'))->with('success_mesage', 'Update Frontend Column successfully.');
    }

    public function getSocialScreen() {
        $social = Setting::where('config_name', 'social')->first();
        $social = json_decode($social->config_setting, true);
        return view('backend.setting.social.index', compact('social'));
    }

    public function postSocial(Request $request) {
        $this->validate($request, 
            [
                'facebook' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                'twitter' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                'google' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                'pinterest' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                'linkedin' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
                'yahoo' => 'nullable|regex:/^(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/',
            ], 
            [
                'facebook.regex' => 'Facebook format not true',
                'twitter.regex' => 'Twitter format not true',
                'google.regex' => 'Google+ format not true',
                'pinterest.regex' => 'Pinterest format not true',
                'linkedin.regex' => 'Linkedin format not true',
                'yahoo.regex' => 'Yahoo format not true',
            ]);
        $social = Setting::where('config_name', 'social')->first();

        $data = [
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'google' => $request->google,
            'pinterest' => $request->pinterest,
            'linkedin' => $request->linkedin,
            'yahoo' => $request->yahoo
        ];

        $data = json_encode($data);
        $social->config_setting = $data;
        $social->save();

        $log = new Log();
        $log->changelog = 'Update ' . '<b><font color="#f4e242">Social</font></b>';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::SETTING_SOCIAL_FUNCTION;
        $log->save();

        return redirect(route('social'))->with('success_mesage', 'Update Social successfully.');
    }

    public function getCodeExampleScreen() {
        return view('backend.setting.code-example.index');
    }

    public function underConstruct() {
        $status = Setting::where('config_name', 'under_construct')->first();
        $status = $status->config_setting;
        return view('backend.setting.under-construct.index', compact('status'));
    }

    public function postunderConstruct(Request $request){
        $setting = $request->select;
        $status = Setting::where('config_name', 'under_construct')->first();
        $status->config_setting = $setting;
        $status->save();

        $log = new Log();
        $log->changelog = 'Update ' . '<b><font color="#087a70">Under Construction Status</font></b>';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::SETTING_UNDER_CONSTRUCTION;
        $log->save();

        return redirect(route('underConstruct'))->with('success_mesage', 'Update Under Construction Status successfully.');

    }

    public function getSearchData() {
        $search = SearchData::orderBy('search_count','DESC')->get();
        return view('backend.setting.search-data.index', compact('search'));
    }

    public function deleteSearchData($id) {
        $search = SearchData::find($id);
        $search->delete();

        return back()->with('success_mesage', 'Delete Item Search Data successfully.');
    }

    public function resetSearchData() {
        SearchData::query()->delete();
        return back()->with('success_mesage', 'Delete All Search Data successfully.');
    }

    public function popupSetting() {
        $popup = Setting::where('config_name', 'popup')->first();
        $popup = json_decode($popup->config_setting, TRUE); 
        return view('backend.setting.popup.index', compact('popup'));
    }

    public function postpopupSetting(Request $request) {
        $popup = Setting::where('config_name', 'popup')->first();
        $state = $request->state;
        $title = $request->title;
        $content = $request->content;

        $arrData = [];
        $arrData['state'] = $state;
        $arrData['title'] = $title;
        $arrData['content'] = $content;

        $arrData = json_encode($arrData);

        $popup->config_setting = $arrData;
        $popup->save();
        $cookie = \Cookie::queue(\Cookie::forget('popup'));

        return redirect(route('popupSetting'))->with('success_mesage', 'Update POPUP Successfull');;
    }

    public function requestHD() {
        $request = RequestHD::all();
        return view('backend.setting.requesthd.index', compact('request'));
    }

    public function requestHDFront(Request $request) {
        if ($request->tenphim == "") {
            return back()->with('baoloi', 'Vui lòng không bỏ trống tên phim yêu cầu');
    }
        $obj = new RequestHD();
        $obj->ip = $request->ip();
        $obj->name = $request->tenphim;
        $obj->save();
        return back()->with('thanhcong', 'Đã gửi yêu cầu phim thành công');
    }

    public function deleteRequestHD($id) {
        $request = RequestHD::find($id);
        $request->delete();
        return back()->with('success_mesage', 'Xóa yêu cầu phim thành công ');
    }

    public function donateSetting() {
        $donate_setting = Setting::where('config_name', 'donate_info')->get();
        if ($donate_setting->count() == 0) {
            $donate_setting = new Setting();
            $donate_setting->config_name = 'donate_info';
            $donate_setting->config_setting = '';
            $donate_setting->save();
        }
        unset($donate_setting);
        $donate_setting = Setting::where('config_name', 'donate_info')->first();
        return view('backend.setting.donate.index.index', compact('donate_setting'));
    }

    public function donateCourseList() {
        $list = DonateListCourse::all();
        return view('backend.setting.donate.listcourse.listcourse', compact('list'));
    }

    public function donateBranchCourse() {
        $branch = BranchCourse::all();
        return view('backend.setting.donate.branchcourse.index', compact('branch'));
    }

    public function donateMember() {
        return view('backend.setting.donate.member.index');
    }

    public function deleteDonateCourse($id) {
        $item = DonateListCourse::findOrFail($id);
        $item->delete();
        return back()->with('success_mesage', 'Xóa khóa học thành công');
    }

    public function deleteDonateBranchCourse($id) {
        $item = BranchCourse::findOrFail($id);
        $item->delete();
        return back()->with('success_mesage', 'Xóa nguồn khóa học thành công');
    }

    public function editDonateCourse($id) {
        $course = DonateListCourse::findOrFail($id);
        $branch = BranchCourse::all();
        $cats = Category::all();
        return view('backend.setting.donate.listcourse.edit.index', compact('course','branch','cats'));
    }

    public function posteditDonateCourse(Request $request, $id) {
        $this->validate($request,
            [
                'coursename' => 'required',
                'courseoriginlink' => 'required',
                'courselink' => 'required',
                'coursebranch' => 'required'
            ], [
                'coursename.required' => 'Không được để trống trường !',
                'courseoriginlink.required' => 'Không được để trống trường !',
                'courselink.required' => 'Không được để trống trường !',
                'coursebranch.required' => 'Không được để trống trường !'
            ]);
        $course = DonateListCourse::findOrFail($id);
        $course->course_name = $request->coursename;
        $course->originlink = $request->courseoriginlink;
        $course->link = $request->courselink;
        if (isset($request->courselink2)) {
            $course->backuplink = $request->courselink2;
        }
        $course->branch_course_id = $request->coursebranch;
        $course->cat_id = $request->category;
        $course->save();
        return back()->with('success_mesage', 'Cập nhật thông tin thành công');
    }

    public function editDonateBranchCourse($id) {
        $branch = BranchCourse::findOrFail($id);
        return view('backend.setting.donate.branchcourse.edit.index', compact('branch'));
    }

    public function posteditDonateBranchCourse(Request $request, $id) {
        $this->validate($request,
            [
                'branchcourse' => 'required'
            ], [
                'branchcourse.required' => 'Không được để trống trường !'
            ]);
        $branch = BranchCourse::findOrFail($id);
        $branch->branch_name = $request->branchcourse;
        $branch->save();
        return back()->with('success_mesage', 'Cập nhật thông tin thành công');
    }

    public function updateDonateInfo(Request $request) {
        $donate_setting = Setting::where('config_name', 'donate_info')->get();
        if ($donate_setting->count() == 0) {
            $donate_setting = new Setting();
            $donate_setting->config_name = 'donate_info';
            $donate_setting->config_setting = '';
            $donate_setting->save();
        }
        unset($donate_setting);
        $donate_setting = Setting::where('config_name', 'donate_info')->first();
        $donate_setting->config_setting = $request->donate_info;
        $donate_setting->save();
        return back()->with('success_mesage', 'Cập nhật thông tin donate thành công');
    }

    public function addDonateCourse() {
        $branch = BranchCourse::all();
        $cats = Category::all();
        return view('backend.setting.donate.listcourse.add.index', compact('branch', 'cats'));
    }

    public function postaddDonateCourse(Request $request) {
         $this->validate($request,
            [
                'coursename' => 'required',
                'courseoriginlink' => 'required',
                'courselink' => 'required',
                'coursebranch' => 'required'
            ], [
                'coursename.required' => 'Không được để trống trường !',
                'courseoriginlink.required' => 'Không được để trống trường !',
                'courselink.required' => 'Không được để trống trường !',
                'coursebranch.required' => 'Không được để trống trường !'
            ]);
        $item = new DonateListCourse();
        $item->course_name = $request->coursename;
        $item->originlink = $request->courseoriginlink;
        $item->link = $request->courselink;
        if (isset($request->courselink2)) {
            $item->backuplink = $request->courselink2;
        }
        $item->branch_course_id = $request->coursebranch;
        $item->cat_id = $request->category;
        $item->save();
        return back()->with('success_mesage', 'Cập nhật thông tin thành công');
    }

    public function addDonateBranchCourse() {
        return view('backend.setting.donate.branchcourse.add.index');
    }

    public function postaddDonateBranchCourse(Request $request) {
        $this->validate($request,
            [
                'branchcourse' => 'required'
            ], [
                'branchcourse.required' => 'Không được để trống trường !'
            ]);
        $branch = new BranchCourse();
        $branch->branch_name = $request->branchcourse;
        $branch->save();

        return back()->with('success_mesage', 'Thêm mới nguồn thành công');
    }
}
