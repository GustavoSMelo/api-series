<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episodes extends Model {

    protected $fillable = ['name', 'season', 'ep_number', 'watched', 'serie_id'];
    protected $perPage = 5;

    public function series()
    {
        $this->belongsTo(Series::class);
    }

    public function getWatchedAttribute ($value) : bool {
        return (bool) $value;
    }
}
