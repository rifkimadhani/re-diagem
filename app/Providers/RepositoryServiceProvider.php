<?php

namespace App\Providers;
// Parent
use App\Repository\BaseRepository;
use App\Repository\EloquentRepositoryInterface;

//  Interfaces.
use App\Repository\Interfaces\TransaksiRepositoryInterface;
use App\Repository\Eloquent\TransaksiRepository;
use App\Repository\Interfaces\SupplierRepositoryInterface;
use App\Repository\Eloquent\SupplierRepository;
use App\Repository\Interfaces\PegawaiRepositoryInterface;
use App\Repository\Eloquent\PegawaiRepository;
use App\Repository\Interfaces\OutletRepositoryInterface;
use App\Repository\Eloquent\OutletRepository;
use App\Repository\Interfaces\PelangganRepositoryInterface;
use App\Repository\Eloquent\PelangganRepository;
use App\Repository\Interfaces\ProdukRepositoryInterface;
use App\Repository\Eloquent\ProdukRepository;
//  Eloquent.

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(TransaksiRepositoryInterface::class, TransaksiRepository::class);
        $this->app->bind(SupplierRepositoryInterface::class, SupplierRepository::class);
        $this->app->bind(PegawaiRepositoryInterface::class, PegawaiRepository::class);
        $this->app->bind(OutletRepositoryInterface::class, OutletRepository::class);
        $this->app->bind(PelangganRepositoryInterface::class, PelangganRepository::class);
        $this->app->bind(ProdukRepositoryInterface::class, ProdukRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
