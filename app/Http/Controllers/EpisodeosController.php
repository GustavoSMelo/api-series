<?php

namespace App\Http\Controllers;

use App\Models\Episodes;
use DomainException;
use Exception;
use Illuminate\Http\Request;

class EpisodeosController extends BaseCustomController {
    public function __construct() {
        parent::__construct(Episodes::class);
    }

    public function perSeries (int $id, Request $request) {
        try {
            $offset = ($request->page - 1) * 5;
            $episodes = Episodes::query()
                ->where('serie_id', $id)
                ->offset($offset)
                ->limit(5)
                ->get();

            if(count($episodes) <= 0) {
                throw new DomainException();
            }

            return $episodes;

        } catch (Exception $err) {
            return response()->json([
                'Error' => 'Could not find any episodeos in this serie'
            ], 404);
        }
    }
}
