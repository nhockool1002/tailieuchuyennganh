<?php

namespace App\Http\Controllers\adminV2;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\adminV2\UserRequest\ChangeAvatarRequest;
use App\Traits\SetRolesUserTraits;

use App\User;
use Spatie\Permission\Models\Role;

use File;
use Exception;
use Auth;
use DB;

class UserControllerV2 extends Controller
{
    use SetRolesUserTraits;

    public function getAll() {
        $users = User::all();
        $roles = Role::all();
        return view('admin-v2.user.index', compact('users', 'roles'));
    }

    public function getUser($id) {
        $user = User::with('roles')->find($id);
        $isSuperAdmin = $user->hasRole('super-admin') ? true : false;
        if ($user) {
            return response()->json([
                'status' => 'success',
                'user' => $user,
                'is_super_admin' => $isSuperAdmin
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'User not found.',
            ], 404);
        }
    }

    /**
     * Handle update avatar for user
     * @param $id id of user
     *
     * @return json
     */
    public function updateAvatarUser(ChangeAvatarRequest $request, $id) {
        $user = User::find($id);
        $currentUser = Auth::user()->id;

        if ($id === '1' && $currentUser !== 1) {
            return response()->json(['error' => '[CHANGE AVATAR]: Only Root Admins can edit themselves'], 400);
        }

        if ($request->hasFile('file')) {
            try {
                DB::beginTransaction();
                File::delete('upload/users/images/' . $user->avatar);
                $file = $request->file('file');

                $rand = rand_string(5);
                $nameFile = $file->getClientOriginalExtension();
                $revStr = revstr($rand);
                $name = $rand . $revStr . "." . $nameFile;
                $file->move('upload/users/images/', $name);
                $user->avatar = $name;
                $user->save();
                DB::commit();
                return response()->json(['success' => 'File uploaded successfully.', 'file_name' => $name], 200);
            } catch (Exception $e) {
                DB::rollback();
                return response()->json(['error' => '[CHANGE AVATAR]: ' . $e->getMessage()], 400);
            }
        }

        return response()->json(['error' => 'No file uploaded.'], 400);
    }

    /**
     * Handle update avatar for user
     * @param $id id of user
     *
     * @return json
     */
    public function updateUser(Request $request, $id) {
        // AL
        $this->removeAllRoleOfUser($id);
        return response()->json(['success' => 'Remove role successfully.'], 200);
    }
}
