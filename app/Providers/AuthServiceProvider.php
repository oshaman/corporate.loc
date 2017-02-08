<?php

namespace Corp\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use Corp\Article;
use Corp\User;
use Corp\Policies\ArticlePolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
     protected $policies = [
        Article::class => ArticlePolicy::class
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        
        Gate::define('VIEW_ADMIN', function ($user) {
        	return $user->canDo('VIEW_ADMIN', FALSE);
        });

        Gate::define('VIEW_ADMIN_ARTICLES', function ($user) {
                    return $user->canDo('VIEW_ADMIN_ARTICLES', FALSE);
        });
        
        Gate::define('EDIT_USERS', function ($user) {
        	return $user->canDo('EDIT_USERS', FALSE);
        });
        //
    }
}
