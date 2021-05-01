<?php
namespace App\Repository\Interfaces;

use App\Models\Mitra;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

interface PegawaiRepositoryInterface
{
    public function getAll();
}
