<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PropertyType;
use DataTables;

class PropertyTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index()
    {
		return view('admin.master_property_data.property_type.list');
    }
	
	public function propertyTypelist()
    {
        $get_property_types = PropertyType::get();
		
        return datatables()->of($get_property_types)
			->addIndexColumn()
			->addColumn('action', function($data){
				return '
				<a href="' . route('property-type.edit',$data->id) . '" class="icon__1"><i class="fa fa-edit"></i></a>
				<a href="' . route('property-type.delete',$data->id) . '" class="icon__2" onClick="return confirm_click()"><i class="fa fa-trash-alt"></i></a>';
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
		return view('admin.master_property_data.property_type.create');
    }
	
	public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
        ]);
		
		$property_type = new PropertyType();
		$property_type->title = $request->title;
		$property_type->save();
		
		return redirect()->route('property-type.index')->with('success', 'Property type added successfully.');
    }
	
	public function edit(PropertyType $property_type)
    {
        return view('admin.master_property_data.property_type.edit', compact('property_type'));
    }
	
	public function update(Request $request, PropertyType $property_type)
    {
        $data = $request->validate([
            'title' => 'required',
			'status' => 'required',
        ]);
		
        $property_type = PropertyType::find($property_type->id);
		$property_type->title = $request->title;
		$property_type->status = $request->status;
		$property_type->save();
		
		return redirect()->route('property-type.index')->with('success', 'Property type updated successfully.');
    }
	
	public function delete($id)
	{
		$building_type = PropertyType::find($id);
		$building_type->delete();
		
		return redirect()->route('property-type.index')->with('success', 'Property type deleted successfully.');
		
	}
}
