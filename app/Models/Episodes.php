<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episodes extends Model {

    protected $fillable = ['name', 'season', 'ep_number', 'watched'];

    public function series()
    {
        $this->belongsTo(Series::class);
    }
}
