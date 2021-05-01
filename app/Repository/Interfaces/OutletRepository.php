<?php
namespace App\Repository\Interfaces;

use App\Models\Outlet;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface OutletRepositoryInterface
{
    public function getAll();
}
