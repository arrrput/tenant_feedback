<?php

namespace App\Providers;

use App\Models\Requests;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
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

        config(['app.locale' =>'id']);
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
        View::composer('admin.*', function ($view) {
            $id_dept = Auth::user()->id_department;
            $allnotif = DB::table('requests')->whereNot('progress_request','=',4)->count();
            $new_notif = DB::table('requests')->where('progress_request','=',1)->count();
            $pending_notif = DB::table('requests')->where('progress_request','=',2)->count();
            $req_notif = DB::table('requests')->where('progress_request','=',3)->count();
            $req = DB::table('requests')
                ->where('id_department', '=', $id_dept)
                ->where('progress_request', '=', 1)
                ->get();
                $c = $req->count();
            return $view->with('counts', $c)
            ->with('allnotif', $allnotif)
            ->with('new_notif', $new_notif)
            ->with('pending_notif', $pending_notif)
            ->with('req_notif', $req_notif);
        });

        View::composer('report.*', function ($view) {
            $id_dept = Auth::user()->id_department;
            $allnotif = DB::table('requests')->whereNot('progress_request','=',4)->whereNot('progress_request','=',5)->count();
            $new_notif = DB::table('requests')->where('progress_request','=',1)->count();
            $pending_notif = DB::table('requests')->where('progress_request','=',2)->count();
            $req_notif = DB::table('requests')->where('progress_request','=',3)->count();
            $req = DB::table('requests')
                ->where('id_department', '=', $id_dept)
                ->where('progress_request', '=', 1)
                ->get();
                $c = $req->count();
            return $view->with('counts', $c)
            ->with('allnotif', $allnotif)
            ->with('new_notif', $new_notif)
            ->with('pending_notif', $pending_notif)
            ->with('req_notif', $req_notif);
        });

        View::composer('users.*', function ($view) {
            $new_notif = DB::table('requests')->where('progress_request','=',1)->count();
            $pending_notif = DB::table('requests')->where('progress_request','=',2)->count();
            $req_notif = DB::table('requests')->where('progress_request','=',3)->count();
            $id_dept = Auth::user()->id_department;
            $allnotif = DB::table('requests')->whereNot('progress_request','=',4)->count();
            $req = DB::table('requests')
                ->where('id_department', '=', $id_dept)
                ->where('progress_request', '=', 1)
                ->get();
                $c = $req->count();
            return $view->with('counts', $c)
            ->with('allnotif', $allnotif)
            ->with('new_notif', $new_notif)
            ->with('pending_notif', $pending_notif)
            ->with('req_notif', $req_notif);
        });

        View::composer('feedback.*', function ($view) {
            $new_notif = DB::table('requests')->where('progress_request','=',1)->count();
            $pending_notif = DB::table('requests')->where('progress_request','=',2)->count();
            $req_notif = DB::table('requests')->where('progress_request','=',3)->count();
            $id_dept = Auth::user()->id_department;
            $allnotif = DB::table('requests')->whereNot('progress_request','=',4)->count();
            $req = DB::table('requests')
                ->where('id_department', '=', $id_dept)
                ->where('progress_request', '=', 1)
                ->get();
                $c = $req->count();
            return $view->with('counts', $c)
            ->with('allnotif', $allnotif)
            ->with('new_notif', $new_notif)
            ->with('pending_notif', $pending_notif)
            ->with('req_notif', $req_notif);
        });

        View::composer('request.*', function ($view) {
            $new_notif = DB::table('requests')->where('progress_request','=',1)->count();
            $pending_notif = DB::table('requests')->where('progress_request','=',2)->count();
            $req_notif = DB::table('requests')->where('progress_request','=',3)->count();
            $allnotif = DB::table('requests')->whereNot('progress_request','=',4)->count();
            $id_dept = Auth::user()->id_department;
            $req = DB::table('requests')
                ->where('id_department', '=', $id_dept)
                ->where('progress_request', '=', 1)
                ->get();
                $c = $req->count();
            return $view->with('counts', $c)
            ->with('allnotif', $allnotif)
            ->with('new_notif', $new_notif)
            ->with('pending_notif', $pending_notif)
            ->with('req_notif', $req_notif);
        });

        view()->composer('layouts.master', function($view) {
            $theme = \Cookie::get('theme');
            if ($theme == 'darkmode') {
                $theme = 'dark';
            }

            $view->with('theme', $theme);
        });

        view()->composer('layouts.master_auth', function($view) {
            $theme = \Cookie::get('theme');
            if ($theme == 'darkmode') {
                $theme = 'dark';
            }

            $view->with('theme', $theme);
        });

    }
}
