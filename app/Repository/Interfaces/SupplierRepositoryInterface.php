<?php
namespace App\Repository\Interfaces;

use App\Models\Supplier;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface SupplierRepositoryInterface
{
    public function getAll();
}
