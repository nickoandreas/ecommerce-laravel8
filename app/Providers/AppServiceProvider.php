<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;

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
        $data = [
            'konfigurasi' => DB::table('konfigurasi')->first(),
            'kategori2' => DB::table('kategori')
                                ->where('nama_kategori', 'LIKE', '%R2%')
                                ->select('nama_kategori', 'slug_kategori')
                                ->orderBy('nama_kategori', 'ASC')
                                ->get(),
            'kategori4' => DB::table('kategori')
                                ->where('nama_kategori', 'LIKE', '%R4%')
                                ->select('nama_kategori', 'slug_kategori')
                                ->orderBy('nama_kategori', 'ASC')
                                ->get(),
        ];
        View::share('data', $data);
      
    }
}
