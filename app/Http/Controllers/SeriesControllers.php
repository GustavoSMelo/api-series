<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Models\Series;

class SeriesControllers extends Controller {
    public function store (Request $request) {

        try {

            $serieModel = new Series();

            $serieModel->name = $request->input('name');
            $serieModel->sinopse = $request->input('sinopse');
            $serieModel->genre = $request->input('genre');
            $serieModel->age_recommended = $request->input('age_recommended');

            $serieModel->save();

            return response()->json([
                'message' => 'serie created with success '
            ]);

        } catch (Exception $err) {
            return response()->json([
                'error' => 'error to create a new serie '. PHP_EOL . $err
            ], 401);
        }
    }
}
