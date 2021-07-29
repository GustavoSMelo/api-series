<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use App\Models\Series;
use DomainException;

class SeriesControllers extends Controller {
    public function store (Request $request) {

        try {

            $serieModel = new Series();

            $serieModel->name = $request->name;
            $serieModel->sinopse = $request->sinopse;
            $serieModel->genre = $request->genre;
            $serieModel->age_recommended = $request->age_recommended;
            $serieModel->save();

            return response()->json([
                'message' => 'serie created with success '
            ], 201);

        } catch (Exception $err) {
            return response()->json([
                'error' => 'error to create a new serie '. PHP_EOL . $err
            ], 401);
        }
    }

    public function index () {
        try {

            $serieModel = new Series();

            return $serieModel->all();

        } catch (Exception $err) {
            return response()->json([
                'Error' => 'error to get all series'
            ], 500);
        }
    }

    public function show (int $id) {
        try {
            $serieModel = new Series();

            $serie = $serieModel->find($id);

            if (empty($serie)) {
                throw new DomainException('serie not found');
            }

            return $serie;
        } catch (DomainException $err) {
            return response()->json([
                'Error' => $err->getMessage()
            ], 404);
        }
    }

    public function update (Request $request, int $id) {
        try {
            $serie = Series::find($id);

            if(empty($serie)) {
                throw new DomainException('serie not found');
            }

            /*
                $serie->name = $request->name;
                $serie->sinopse = $request->sinopse;
                $serie->genre = $request->genre;
                $serie->age_recommended = $request->age_recommended;
             */

            $serie->fill($request->all());

            $serie->save();

            return response()->json([
                'message' => 'Serie updated with success '
            ], 200);

        } catch (Exception $err) {
            return response()->json([
                'Error' => $err->getMessage()
            ], 404);
        }
    }

    public function destroy (int $id) {

        try {
            Series::destroy($id);

            return response()->json([
                'message' => 'Serie deleted with success'
            ]);
        } catch (Exception $err) {
            return response()->json([
                'Error' => 'Serie not found'
            ], 404);
        }
    }
}
