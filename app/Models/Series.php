<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Series extends Model {

    protected $fillable = ['name', 'sinopse', 'genre', 'age_recommended'];

    public function episodes()
    {
        return $this->hasMany(Episodes::class);
    }
}
