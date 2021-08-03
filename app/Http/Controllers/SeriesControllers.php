<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Exception;

class SeriesControllers extends BaseCustomController {
    public function __construct() {
        parent::__construct(Series::class);
    }
}
