<?php

namespace App\Providers;

use App\Models\News;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Passport\Passport;

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

        Passport::tokensExpireIn(now()->addDays(15));
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));


        // Autorizacija, da li je prijavljeni korisnik subscribe-ovan na kategoriju kojoj pripada vest.
        // Cilj je dodati sloj autorizacione logike nekom custom proverom korisnickih privilegija.
        
        // Gate::define('update-news', function (User $user, News $news) {
        //     $categories = $user->subscribedCategories;
        //     $categoriesArr = [];
        //     $categories->map(function ($cat) use (&$categoriesArr) {
        //         $categoriesArr[] = $cat->id;
        //     });
        //     return in_array($news->categorie_id, $categoriesArr);
        // });
    }
}
