<?php
namespace App\Repository\Interfaces;

use App\Models\Produk;
use App\Models\ProdukVariasi;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface ProdukRepositoryInterface
{
    public function getAll();
    public function variasiInsert(array $attributes);
    public function variasiUpdate(array $attributes);
    public function variasiFind($id);
    public function variasiGet($produk_id);
    public function getKategori();
    public function getMerk();
}
