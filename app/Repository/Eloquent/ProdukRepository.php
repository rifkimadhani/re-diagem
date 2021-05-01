<?php

namespace App\Repository\Eloquent;

use App\Models\ProdukVariasi;
use App\Models\Produk;
use App\Models\Merk;
use App\Models\Kategori;
use App\Repository\Interfaces\ProdukRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use App\Repository\BaseRepository;
use Session;

class ProdukRepository extends BaseRepository implements ProdukRepositoryInterface
{

   /**
    * ProdukRepository constructor.
    *
    * @param User $model
    */
    private $session;
   public function __construct(
       Produk $model,
       ProdukVariasi $variasi,
       Merk $merk,
       Kategori $kategori,
       Session $session
       )
   {
       parent::__construct($model);

       $this->variasi = $variasi;
       $this->merk = $merk;
       $this->kategori = $kategori;
       $this->bisnis_id = Session::get('bisnis.bisnis_id');
   }

   /**
    * @return Collection
    */
    public function getAll()
    {
        // return $this->model->leftJoin('merk', 'produk.merk_id', '=', 'merk.id')
        // ->leftJoin('kategori as k', 'produk.kategori_id', '=', 'k.id')
        // ->leftJoin('variasi_produk_detail as vpd', 'vpd.produk_id', '=', 'produk.id')
        // ->join('variations as v', 'v.product_id', '=', 'products.id')
        // ->where('products.business_id', $business_id)
        // ->where('products.type', '!=', 'modifier')
        // ->select(
        //     'products.id',
        //     'products.name as product',
        //     'products.type',
        //     'c1.name as category',
        //     'c2.name as sub_category',
        //     'units.actual_name as unit',
        //     'brands.name as brand',
        //     'tax_rates.name as tax',
        //     'products.sku',
        //     'products.image',
        //     'products.enable_stock',
        //     'products.is_inactive',
        //     DB::raw('SUM(vld.qty_available) as current_stock'),
        //     DB::raw('MAX(v.sell_price_inc_tax) as max_price'),
        //     DB::raw('MIN(v.sell_price_inc_tax) as min_price')
        // )->groupBy('products.id');
    }

    public function getPaginate($kategori, $merk, $keyword, $page)
    {
        $bisnis_id = Session::get('bisnis.bisnis_id');
        return $this->model->where('bisnis_id', $bisnis_id)
        ->where('kategori_id', 'like', '%' . $kategori . '%')
        ->where('merk_id', 'like', '%' . $merk . '%')
        ->where('nama', 'like', '%' . $keyword . '%')
        ->paginate($page);
    }

    public function variasiInsert(array $attributes)
    {
        $attributes['bisnis_id'] = $this->bisnis_id;
        return $this->variasi->create($attributes);
    }

    public function variasiGet($produk_id)
    {
        return $this->variasi->where('produk_id', $produk_id)->get();
    }

    public function variasiUpdate(array $attributes)
    {
        return $this->variasi->updateOrCreate($attributes);
    }

    public function variasiFind($id)
    {
        return $this->variasi->find($id);
    }

    public function getKategori()
    {
        return $this->kategori->where(function($q) {
            $q->where('bisnis_id', Session::get('bisnis.bisnis_id'))
              ->orWhere('bisnis_id', null);
        })->orderBy('created_at', 'DESC')->get();
    }

    public function getMerk()
    {
        return $this->merk->where(function($q) {
            $q->where('bisnis_id', Session::get('bisnis.bisnis_id'))
              ->orWhere('bisnis_id', null);
        })->orderBy('created_at', 'DESC')->get();
    }

}
