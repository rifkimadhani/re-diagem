<?php
namespace App\Repository\Interfaces;

use App\Models\Pelanggan;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface PelangganRepositoryInterface
{
    public function getAll();
}
