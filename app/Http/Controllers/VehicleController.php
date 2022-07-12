<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class VehicleController extends Controller
{

    protected $vehicle;
    protected $brand;

    public function __construct()
    {
        $this->vehicle = new Vehicle();
        $this->brand = new Brand();

    }
    public function vehicles()
    {
        $items = $this->vehicle->orderby("id", "DESC")->paginate(2);

        return view("webapp.vehicles", compact("items"));
    }
    public function create()
    {
        $is_create = true;
        $brands = $categories = $this->brand->all();
        return view('webapp.vehicle.form', compact('is_create', 'brands'));
    }

    public function save(Request $request)
    {
        DB::beginTransaction();
        try {
            $data = $request->all();

            //validation data
            $validator = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'number_plate' => 'required|max:20',
                'brand_id' => 'required',
            ]);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            //save data
            $item = $this->vehicle;
            $item->name = $data['name'];
            $item->brand_id = $data['brand_id'];
            $item->number_plate = $data['number_plate'];
            $item->features = $data['features'];
            $item->save();
           

            DB::commit();
            return redirect()->route('vehicles')->with('message', 'Registro realizado con éxito.');

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage(), 400);
        }
    }
}
