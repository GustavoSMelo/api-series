<?php

namespace App\Http\Controllers;

use App\Models\Series;
use Exception;
use Illuminate\Http\Request;

class SeriesControllers extends BaseCustomController {
    public function __construct() {
        parent::__construct(Series::class);
    }

    public function index (Request $request) {
        try {

            $information = new Series();

            if (count($information->all()) <= 0) {
                return response()->json([
                    "Error" => "Any serie was finded "
                ]);
            }

            $offset = ($request->page - 1) * 5;

            $paginate = $information->query()
                ->offset($offset)
                ->limit(5)
                ->get();

            foreach ($paginate as $item) {
                $item['episodes_link'] = env('APP_URL') . "/api/series/{$item->id}/episodeos";
            }

            return $paginate;

        } catch (Exception $err) {
            return response()->json([
                "Error" => "error to get all serie"
            ], 500);
        }
    }
}
