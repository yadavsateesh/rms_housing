<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Measurement;
use DataTables;

class MeasurementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index()
    {
		return view('admin.master_property_data.measurement.list');
    }
	
	public function measurementlist()
    {
        $get_measurements = Measurement::get();
		
        return datatables()->of($get_measurements)
			->addIndexColumn()
			->addColumn('action', function($data){
				return '
				<a href="' . route('measurement.edit',$data->id) . '" class="icon__1"><i class="fa fa-edit"></i></a>
				<a href="' . route('measurement.delete',$data->id) . '" class="icon__2" onClick="return confirm_click()"><i class="fa fa-trash-alt"></i></a>';
			})
			->editColumn('status', function($data){
				return $data->status == 1 ? '<span class="badge light badge-success">Active</span>' : '<span class="badge light badge-danger">Inactive</span>';
			})
			->editColumn('created_at', function($data){
				return date('Y-m-d H:i:s', strtotime($data->created_at));
			})
			->rawColumns(['status', 'action'])
			->make(true);
	}
	
	public function create()
    {
		return view('admin.master_property_data.measurement.create');
    }
	
	public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
        ]);
		
		$measurement = new Measurement();
		$measurement->title = $request->title;
		$measurement->save();
		
		return redirect()->route('measurement.index')->with('success', 'Measurement added successfully.');
    }
	
	public function edit(Measurement $measurement)
    {
        return view('admin.master_property_data.measurement.edit', compact('measurement'));
    }
	
	public function update(Request $request, Measurement $measurement)
    {
        $data = $request->validate([
            'title' => 'required',
			'status' => 'required',
        ]);
		
        $measurement = Measurement::find($measurement->id);
		$measurement->title = $request->title;
		$measurement->status = $request->status;
		$measurement->save();
		
		return redirect()->route('measurement.index')->with('success', 'Measurement updated successfully.');
    }
	
	public function delete($id)
	{
		$measurement = Measurement::find($id);
		$measurement->delete();
		
		return redirect()->route('measurement.index')->with('success', 'Measurement deleted successfully.');
		
	}
}
