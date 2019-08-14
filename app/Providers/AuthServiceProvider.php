<?php

namespace App\Providers;


use App\User;
use App\Alumno;
use App\Libro;

use App\Policies\Userpolicy;
use App\Policies\Alumnopolicy;
use App\Policies\Libropolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => Userpolicy::class,
        Alumno::class => Alumnopolicy::class,
        Libro::class => Libropolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //

    }
}
