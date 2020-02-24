<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function getPermissions($user, $group) {
        $subCategories = config('constants.permissions')[$group];
        $permissions = new \stdClass();

        $data = $user->getAllPermissions()->where('category', $group)->pluck('sub_category', 'name');
        foreach($subCategories as $subCategory) {
            $permission = new \stdClass();
            foreach($data as $key => $value) {
                if ($subCategory == $value) {
                    $permission->$key = true;
                }
            }
            $permissions->$subCategory = $permission;
        }

        return $permissions;
    }
}
