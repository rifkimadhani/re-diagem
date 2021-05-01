<?php

use App\Models\Mitra;
use App\Models\Bisnis;
use App\Models\BisnisKategori;
use App\Models\Outlet;
use Illuminate\Database\Seeder;

class MitraTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $mitra = new Mitra;
        $mitra->nama = 'Mitra 1';
        $mitra->username = 'mitra';
        $mitra->email = 'mitra@mitra.com';
        $mitra->hp = '089656466525';
        $mitra->password = Hash::make('admin123');
        $mitra->daerah_id = 25826;
        $mitra->alamat = 'ASdknaslkd';
        $mitra->save();

        $kategori = new BisnisKategori;
        $kategori->nama = 'Warung Sembako';
        $kategori->save();

        $bisnis = new Bisnis;
        $bisnis->nama = 'Toko 1';
        $bisnis->kategori_id = $kategori->id;
        $bisnis->save();

        $outlet = new Outlet;
        $outlet->bisnis_id = $bisnis->id;
        $bisnis->save();

    }
}
