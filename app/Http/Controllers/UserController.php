<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Log;
use Illuminate\Support\Facades\Auth;
use App\Permission;
use File;
use Illuminate\Support\Facades\DB;
use Exception;
use App\Http\Controllers\Controller;
use App\UserTpoint;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function getAll()
    {
        $users = User::paginate(10);
        return view('backend.user.index', compact('users'));
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $role = Role::all();
        return view('backend.user.edit', compact('user', 'role'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);

        if ($id == 1) {
            unset($request->role);
            $request['role'] = 'admin';
        }

        $data = [
            'user_id' => $id,
            'role' => $request->role
        ];

        $this->validate($request,
            [
                'username' => 'required|min:3|max:40',
                'email' => 'required',
                // 'role' => [
                //     'required_if:userId,!=,1', // validate only if userId is not 1
                //     'in:admin,super-moderator,moderator,member,banned,s-member,vip-member'
                // ],
                'role' => [
                    'required',
                    function ($attribute, $value, $fail) use ($data) {
                        if ($data['user_id'] == 1 && !in_array($value, ['super-admin', 'admin', 'super-moderator', 'moderator', 'member', 'banned', 's-member', 'vip-member'])) {
                            $fail('The role selected :attribute is invalid.');
                        }
                        if ($data['user_id'] != 1 && !in_array($value, ['admin', 'super-moderator', 'moderator', 'member', 'banned', 's-member', 'vip-member'])) {
                            $fail('The role selected :attribute is invalid.');
                        }
                    },
                ],
            ],
            [
                'username.required' => 'Username không được để trống',
                'username.min' => 'Username có ít nhất là 3 ký tự',
                'username.max' => 'Username có nhiều nhất 40 ký tự',
                'email.required' => 'Email không được để trống',
            ]);
        $nemo = $user->username;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role_id = 3;
        $user->sign = $request->sign;

        if ($request->hasFile('avatar')) {
            File::delete('upload/users/images/' . $user->avatar);
            $file = $request->avatar;
            $rand = rand_string(5);
            $namefile = $file->getClientOriginalExtension();
            $revstr = revstr($rand);
            $name = $rand . $revstr . "." . $namefile;
            $file->move('upload/users/images/', $name);
            $user->avatar = $name;
        }

        if ($request->password != '') {
            $user->password = bcrypt($request->password);
        }

        if ($request->aboutme != '') {
            $user->aboutme = $request->aboutme;
        }

        $log = new Log();
        $log->changelog = 'Update Users ' . '<b><font color="green">' . $nemo . '</font></b>';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::DELETE_USER_FUNCTION;
        $log->save();

        if ($request->role === 'vip-member') {
            $user->is_vip = true;
        }
        $user->save();
        // $user->syncRoles([]);
        $user->assignRole($request->role);
        return redirect(route('editUser', $id))->with('success_mesage', 'Member information update successfully.');
    }

    public function deleteUser($id)
    {
        if ($id == 1) {
            return redirect(route('user'))->with('danger_mesage', 'Can\'t delete super administrator.');
        }
        $user = User::find($id);

        $log = new Log();
        $log->changelog = 'Delete Users ' . '<b><font color="green">' . $user->username . '</font></b>';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::DELETE_USER_FUNCTION;
        $log->save();

        $user->delete();
        return redirect(route('user'))->with('success_mesage', 'Member has been deleted.');
    }

    public function addUser()
    {
        $role = Role::all();
        return view('backend.user.add', compact('role'));
    }

    public function postaddUser(Request $request)
    {
        $this->validate($request,
            [
                'username' => 'required|min:3|max:40',
                'password' => 'required|min:6|max:24',
                'email' => 'required',
                'role' => 'in:admin,super-moderator,moderator,member,banned,s-member,vip-member'
            ],
            [
                'username.required' => 'Username không được để trống',
                'username.min' => 'Username có ít nhất là 3 ký tự',
                'username.max' => 'Username có nhiều nhất 40 ký tự',
                'password.min' => 'Password có ít nhất là 6 ký tự',
                'password.max' => 'Password có nhiều nhất là 24 ký tự',
                'email.required' => 'Email không được để trống',
            ]);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->role_id = 3;
        $user->password = bcrypt($request->password);
        $user->aboutme = $request->aboutme;
        $user->remember_token = $request->_token;

        if ($request->hasFile('avatar')) {
            $file = $request->avatar;
            $rand = rand_string(5);
            $namefile = $file->getClientOriginalExtension();
            $revstr = revstr($rand);
            $name = $rand . $revstr . "." . $namefile;
            $file->move('upload/users/images/', $name);
            $user->avatar = $name;
        }

        $log = new Log();
        $log->changelog = 'Add Users ' . '<b><font color="green">' . $request->username . '</font></b>';
        $log->user = Auth::user()->username;
        $log->screen = \Constant::ADD_USER_FUNCTION;
        $log->save();

        if ($request->role === 'vip-member') {
            $user->is_vip = true;
        }

        $user->save();

        $user->syncRoles([]);
        $user->assignRole($request->role);
        UserTpoint::create(['user_id' => $user->id, 'tpoint' => '0']);

        return redirect(route('editUser', $user->id))->with('success_mesage', 'Add member successfully.');
    }

    public function filterAdmin()
    {
        $users = User::where('role_id','1')->paginate(10);
        return view('backend.user.filter-admin',compact('users'));
    }

    public function filterUser()
    {
        return view('backend.user.filter-user');
    }

    public function postfilterUser(Request $request)
    {
        $username = $request->get('username');
        $users = User::where('username', 'LIKE', '%'.$username. '%')->paginate(10);
        return view('backend.user.filter-user', compact('users'));
    }

    public function searchUsers(Request $request) {
        return User::where('username', 'LIKE', '%'.$request->q.'%')->where('role_id', '>', 1)->get();
    }

    public function upgradeVip(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Lưu trữ thời gian kết thúc của tính năng VIP (1 tuần)
        // $vipExpiration = now()->addWeek();
        $vipExpiration = now()->addSeconds(10);

        try {
            DB::beginTransaction();
            // Cập nhật trường vip_expiration trong bảng users
            $user->update(['is_vip' => true, 'vip_expired_at' => $vipExpiration]);
            $user->syncRoles([]);
            $user->assignRole('vip-member');
            $log = new Log();
            $log->changelog = '[UPGRADE VIP] FOR ' . $user->username . ' SUCCESS !';
            $log->user = Auth::user()->username;
            $log->screen = "VIP FUNCTION";
            $log->save();
            DB::commit();
            return redirect(route('user'))->with('success_mesage', 'Update VIP for ' . $user->username . ' success !');
        } catch (Exception $e) {
            DB::rollback();
            $log = new Log();
            $log->changelog = '[UPGRADE VIP] FOR ' . $user->username . ' FAILED !';
            $log->user = Auth::user()->username;
            $log->screen = "VIP FUNCTION";
            $log->save();
            return redirect(route('user'))->with('danger_mesage', 'Update VIP for ' . $user->username . ' failed! <br />' . $e->getMessage());
        }
    }

    public function downgradeVip(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($user->hasRole(['vip-member'])) {
            try {
                DB::beginTransaction();
                $user->update(['is_vip' => false, 'vip_expired_at' => null]);
                $user->syncRoles([]);
                $user->assignRole('member');
                $log = new Log();
                $log->changelog = '[DOWNGRADE VIP] FOR ' . $user->username . ' SUCCESS !';
                $log->user = Auth::user()->username;
                $log->screen = "VIP FUNCTION";
                $log->save();
                DB::commit();
                return redirect(route('user'))->with('success_mesage', 'Update UN-VIP for ' . $user->username . ' success !');
            } catch (Exception $e) {
                DB::rollback();
                $log = new Log();
                $log->changelog = '[UPGRADE VIP] FOR ' . $user->username . ' FAILED !';
                $log->user = Auth::user()->username;
                $log->screen = "VIP FUNCTION";
                $log->save();
                return redirect(route('user'))->with('danger_mesage', 'Update UN-VIP for ' . $user->username . ' failed! <br />' . $e->getMessage());
            }
        }
    }
}
