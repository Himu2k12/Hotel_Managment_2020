<?php

namespace App\Providers;

use App\Role;
use App\StaffInformation;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use View;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view)
        {
            if (Auth::check()) {
                //$view->with('currentUser', Auth::user());
                $uid= Auth::user();
                $ProfilePhotos = StaffInformation::where('user_id',$uid->id)->first();
                if (isset($ProfilePhotos)){
                    $sp = $ProfilePhotos->staff_photo;
                    View::Share('dp',$sp);
                }
            }

            if (Auth::check()) {
                $uid= Auth::user();
                $role = Role::where('id',$uid->role_id)->first();
                if (isset($role)){
                    $role = $role->role;
                    View::Share('role',$role);
                }
            }
        });


        $this->registerPolicies();

        Gate::define('isSuper' ,function ($user){
            if ($user->role_id==1 && $user->access==1){
                return true;
            }else{
                return false;
            }
        });

        Gate::define('isManager' ,function ($user){
            if ($user->role_id==2 && $user->access==1){
                return true;
            }else{
                return false;
            }
        });
        Gate::define('isReceptionist' ,function ($user){
            if ($user->role_id==3 && $user->access==1){
                return true;
            }else{
                return false;
            }
        });

        Gate::define('isDeputyManager' ,function ($user){
            if ($user->role_id==4 && $user->access==1){
                return true;
            }else{
                return false;
            }
        });
    }


}
