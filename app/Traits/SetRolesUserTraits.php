<?php

namespace App\Traits;

use Spatie\Permission\Models\Role;
use App\User;

trait SetRolesUserTraits {
  /**
   * Private function to  remove all role of normal user
   * @param $id id of user
   *
   * @return boolean
   */
  private function removeAllRoleOfUser($id) {
    $user = User::find($id);
    if ($user) {
      $superAdminRole = Role::where('name', 'super-admin')->first();
      $hasSuperAdminRole = $user->hasRole($superAdminRole);
      if ($hasSuperAdminRole) {
        return false;
      } else {
        $user->syncRoles([]);
        return true;
      }
    }
  }


  /**
   * Public function set roles for users
   * @param $id id of user
   * @param $listRoles list roles set for user
   *
   * @return boolean
   */
  public function setRoleForUser($id, $listRoles) {
    $user = User::find($id);
    $resetRoleOfUser = $this->removeAllRoleOfUser($id);
    if ($resetRoleOfUser) {
      if (count($listRoles) > 0) {
        foreach ($listRoles as $role) {
          $roleName = Role::findByName($role);
          $user->assignRole($roleName);
        }
      } else {
        $user->syncRoles([]);
        $user->assignRole('member');
      }
      return true;
    } else {
      return false;
    }
  }
}
