<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyFor;
use DataTables;

class PropertyForController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index()
    {
		return view('admin.master_property_data.property_for.list');
    }
	
	public function propertyForlist()
    {
        $get_property_fors = PropertyFor::get();
		
        return datatables()->of($get_property_fors)
			->addIndexColumn()
			->addColumn('action', function($data){
				return '
				<a href="' . route('property-for.edit',$data->id) . '" class="icon__1"><i class="fa fa-edit"></i></a>
				<a href="' . route('property-for.delete',$data->id) . '" class="icon__2" onClick="return confirm_click()"><i class="fa fa-trash-alt"></i></a>';
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
		return view('admin.master_property_data.property_for.create');
    }
	
	public function store(Request $request)
    {
        $data = $request->validate([
            'property_for' => 'required',
        ]);
		
		$property_for = new PropertyFor();
		$property_for->property_for = $request->property_for;
		$property_for->save();
		
		return redirect()->route('property-for.index')->with('success', 'Property for added successfully.');
    }
	
	public function edit(PropertyFor $property_for)
    {
        return view('admin.master_property_data.property_for.edit', compact('property_for'));
    }
	
	public function update(Request $request, PropertyFor $property_for)
    {
        $data = $request->validate([
            'property_for' => 'required',
			'status' => 'required',
        ]);
		
        $property_for = PropertyFor::find($property_for->id);
		$property_for->property_for = $request->property_for;
		$property_for->status = $request->status;
		$property_for->save();
		
		return redirect()->route('property-for.index')->with('success', 'Property for updated successfully.');
    }
	
	public function delete($id)
	{
		$property_for = PropertyFor::find($id);
		$property_for->delete();
		
		return redirect()->route('property-for.index')->with('success', 'Property for deleted successfully.');
		
	}
}
