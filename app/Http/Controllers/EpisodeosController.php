<?php

namespace App\Http\Controllers;

use App\Models\Episodes;

class EpisodeosController extends BaseCustomController {
    public function __construct() {
        parent::__construct(Episodes::class);
    }
}
