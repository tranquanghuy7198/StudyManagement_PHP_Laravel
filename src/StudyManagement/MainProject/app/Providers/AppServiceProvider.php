<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\Student;
use App\Teacher;
use App\Admin;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view)
    {
        if(Auth::check())
        {
            if(Auth::user()->who == 1){
                $person = Student::where('id', Auth::user()->username)->first()->toArray();
               $view->with('person', $person);
           }
            else if(Auth::user()->who == 2){
                $person = Teacher::where('id', Auth::user()->username)->first()->toArray();
                $view->with('person', $person);
            }
            else{
                $person = Admin::where('id', Auth::user()->username)->first()->toArray();
                $view->with('person', $person);
            }
        }
        else{
            $person = array('fullName' => '', 'who' => 0);
            $view->with('person', $person);
        }
        $info['person'] = $person;
    });
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
