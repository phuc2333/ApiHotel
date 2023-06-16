<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Modules;
use App\Models\User;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // users.view
        // Lay danh sach module
        $moduleList = Modules::all();
        if($moduleList->count()>0){
            foreach($moduleList as $module){
                Gate::define($module->name, function(User $user) use ($module){
                    $roleJson = $user->group->permission;
                  
                    if(!empty($roleJson)){
                        $roleArr = json_decode($roleJson,true);

                        $check = isRole($roleArr,$module->name);
                       
                        return $check;
                    }
                    return false;
                });       
            }
        }
    }
}
