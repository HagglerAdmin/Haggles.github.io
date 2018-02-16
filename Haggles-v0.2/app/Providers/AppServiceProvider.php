<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function boot()
    {  

        view()->composer('store.manage', function($view){
            
            $view->with('userPic', resolve('user-picture'));
        });
            
        view()->composer('layouts.navigation', function($view){

            $view->with('picture', resolve('user-picture'))->with('msgCount', resolve('message-count'));
        });

        view()->composer('haggler.profile', function($view){
            
            $view->with('uploaderPicture', resolve('user-picture'))->with('categoryname', resolve('category-name'));
        });

        view()->composer('store.store', function($view){

            $view->with('categoryname', resolve('category-name'));
        });

        view()->composer('category.filter-modal', function($view){
            
            $view->with('category', resolve('category-name'))->with('city', resolve('city-province'));
        });
            
        view()->composer('search.search', function($view){
            
            $view->with('categoryname', resolve('category-name'));
        });

        view()->composer('store.add-product', function($view){
            
            $view->with('categoryname', resolve('category-name'));
        });

        view()->composer('store.edit-product', function($view){
            
            $view->with('categoryname', resolve('category-name'))->with('city', resolve('city-province'));;
        });

        view()->composer('notification.notif', function($view) {
            
            $view->with('notifications', resolve('notifications'));
        });
        
    }

    public function register()
    {
        // navigation user picture
        $this->app->singleton('user-picture', function(){

            return (new \App\Repositories\UserPicture)->display();
        });
        
        $this->app->singleton('message-count', function(){

            return (new \App\Http\Controllers\MessageController)->countUnseen();
        });

        //store category
        $this->app->singleton('category-name', function(){

            return (new \App\Repositories\Categories)->fetch('name');
        });

        //cities and province 
        $this->app->singleton('city-province', function() {

            return (new \App\Repositories\Cities)->all();
        });

        $this->app->singleton('notifications', function() {
            
            return (new \App\Repositories\Notifications)->all();
        });
    }
}
