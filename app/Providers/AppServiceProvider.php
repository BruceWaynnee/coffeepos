<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // dashboard sidebar
        view()->composer(
            'dashboard.partials.sidebar',
            function($view){
                // get category records
                $categories = Category::getCategories();
                $categories = $categories->data;

                $view->with(compact('categories'));
            }
        );
    }
}
