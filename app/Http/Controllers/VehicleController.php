<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Date;

class VehicleController extends Controller
{

    protected $vehicle;
    protected $brand;

    public function __construct()
    {
        $this->vehicle = new Vehicle();
        $this->brand = new Brand();

    }
    public function vehicles(Request $request)
    {
        $parameters = $request->all();
        $search = $request->has('search') ? $request->get('search') : '';
        $brand_id = $request->has('brand') ? $request->get('brand') : '';

        $items = $this->vehicle
        ->where('name', 'LIKE', '%' . $request->get("search") . '%')
        ->where("deleted_at", null)
        ->orderby("id", "DESC");

        
        if (isset($parameters["brand"])) {            
            $items = $items->where('brand_id', $brand_id);
        }

        $items = $items->paginate(2);
        $brands = $this->brand->all();

        return view("webapp.vehicles", compact("items", "brands", "brand_id"));
    }
    public function create()
    {
        $is_create = true;
        $brands = $this->brand->all();
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
            return back()
                    ->withErrors($e->getMessage())
                    ->withInput();
        }
    }

    public function edit($id)
    {
        $is_create = false;
        $item = $this->vehicle->findOrFail($id);
        $brands = $categories = $this->brand->all();
        return view("webapp.vehicle.form", compact('is_create','item', 'brands'));
    }

    public function updated(Request $request, $id)
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

            //updated data
            $item = $this->vehicle->findOrFail($id);
            $item->name = $data['name'];
            $item->brand_id = $data['brand_id'];
            $item->number_plate = $data['number_plate'];
            $item->features = $data['features'];
            $item->save();
           
            DB::commit();
            return redirect()->route('vehicles')->with('message', 'Registro actualizado con éxito.');

        } catch (\Exception $e) {
            DB::rollback();
            return back()
                    ->withErrors($e->getMessage())
                    ->withInput();
        }
    }

    public function destroy($id){

        try {
            // get obj
            $vehicle = $this->vehicle->find($id);
            // ======= borrado ORM
            // $vehicle->delete();

            // habitualmente aplico el borrado lógico | se puede modificar el core para todos los modelos
            $time = Date::now();
            $vehicle->deleted_at = $time;
            $vehicle->save();

            $response = array(
                'status' => 'success'
            );
            
            return response()->json($response);

        } catch (\Exception $e) {
            DB::rollback();
            return response()->json($e->getMessage());
        }

    }

    public function generatePDf(){

        $title = "Exportar Vehiculos";
        $items = $this->vehicle
        ->where("deleted_at", null)
        ->get();

        $pdf = \PDFD::loadView('pdf.vehicles', compact("title", "items"));
        return $pdf->stream("", array('Attachment'=>0));
    
        // return $pdf->download('sample.pdf');

    }
}
