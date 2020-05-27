<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Contracts\Auth\Access\Gate as GateContract;

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
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $gate->define('edit-recipe', function ($user, $recipe) {
            return $user->id == $recipe->user_id;
        });

        $gate->define('update-recipe', function ($user, $recipe) {
            return $user->id == $recipe->user_id;
        });

        $gate->define('delete-recipe', function ($user, $recipe) {
            return $user->id == $recipe->user_id;
        });
    }
}
