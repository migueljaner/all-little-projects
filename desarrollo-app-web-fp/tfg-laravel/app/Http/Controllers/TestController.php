<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class TestController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {  
    }

    public function index(Request $request)
    {

        $user = Auth::user();
        $user->assignRole('writer');

        // Role is permission.
        //$role = Role::create(['name' => 'writer']);

        // Permission is group roles.
        //$permission = Permission::create(['name' => 'edit articles']);

        // Assigned permission a role
        //$role->givePermissionTo($permission);
        // Assigned role a permission
        //$permission->assignRole($role);
        
        if($user->profile){
            return 'false';
        }

        if($user->hasRole('writer')){

            return 'true';

        }

        return 'ok';

    }

}
