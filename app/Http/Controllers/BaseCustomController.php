<?php
namespace App\Http\Controllers;

use DomainException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Env;

abstract class BaseCustomController extends Controller{

    protected $cls;

    public function __construct($cls)
    {
        $this->cls = $cls;
    }

    public function store (Request $request) {

        try {

            $this->cls::create($request->all());

            return response()->json([
                "message" => "{$this->cls} created with success "
            ], 201);

        } catch (Exception $err) {
            return response()->json([
                "error" => "error to create a new {$this->cls} ". PHP_EOL . $err
            ], 401);
        }
    }

    public function index (Request $request) {
        try {

            $information = new $this->cls();

            if (count($information->all()) <= 0) {
                return response()->json([
                    "Error" => "Any {$this->cls} was finded "
                ]);
            }

            $offset = ($request->page - 1) * 5;

            $paginate = $information->query()
                ->offset($offset)
                ->limit(5)
                ->get();

            foreach ($paginate as $item) {
                $item['episodeos_link'] = env("APP_URL") . "/series/{$item->id}/episodeos";
            }

            return $paginate;

        } catch (Exception $err) {
            return response()->json([
                "Error" => "error to get all {$this->cls}"
            ], 500);
        }
    }

    public function show (int $id) {
        try {
            $information = new $this->cls();

            $finded = $information->find($id);

            if (empty($finded)) {
                throw new DomainException("This {$this->cls} not found");
            }

            return $finded;
        } catch (DomainException $err) {
            return response()->json([
                "Error" => $err->getMessage()
            ], 404);
        }
    }

    public function update (Request $request, int $id) {
        try {
            $information = $this->cls::find($id);

            if(empty($information)) {
                throw new DomainException("{$this->cls} not found");
            }

            $information->fill($request->all());

            $information->save();

            return response()->json([
                "message" => "{$this->cls} updated with success "
            ], 200);

        } catch (Exception $err) {
            return response()->json([
                "Error" => $err->getMessage()
            ], 404);
        }
    }

    public function destroy (int $id) {

        try {
            $this->cls::destroy($id);

            return response()->json([
                "message" => "{$this->cls} deleted with success"
            ]);
        } catch (Exception $err) {
            return response()->json([
                "Error" => "{$this->cls} not found"
            ], 404);
        }
    }
}
