<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $table = 'company';
    public $timestamps = false;

    /**
     * Récupère les résultats.
     */
    public function results()
    {
        return $this->hasMany(Results::class)->orderBy('year', 'desc');
    }
}
