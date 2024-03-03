<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BuildingType;
use DataTables;

class BuildingTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index()
    {
		return view('admin.master_property_data.building_type.list');
    }
	
	public function buildingTypelist()
    {
        $get_building_types = BuildingType::get();
		
        return datatables()->of($get_building_types)
			->addIndexColumn()
			->addColumn('action', function($data){
				return '
				<a href="' . route('building-type.edit',$data->id) . '" class="icon__1"><i class="fa fa-edit"></i></a>
				<a href="' . route('building-type.delete',$data->id) . '" class="icon__2" onClick="return confirm_click()"><i class="fa fa-trash-alt"></i></a>';
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
		return view('admin.master_property_data.building_type.create');
    }
	
	public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
        ]);
		
		$building_type = new BuildingType();
		$building_type->title = $request->title;
		$building_type->save();
		
		return redirect()->route('building-type.index')->with('success', 'Building type added successfully.');
    }
	
	public function edit(BuildingType $building_type)
    {
        return view('admin.master_property_data.building_type.edit', compact('building_type'));
    }
	
	public function update(Request $request, BuildingType $building_type)
    {
        $data = $request->validate([
            'title' => 'required',
			'status' => 'required',
        ]);
		
        $building_type = BuildingType::find($building_type->id);
		$building_type->title = $request->title;
		$building_type->status = $request->status;
		$building_type->save();
		
		return redirect()->route('building-type.index')->with('success', 'Building type updated successfully.');
    }
	
	public function delete($id)
	{
		$building_type = BuildingType::find($id);
		$building_type->delete();
		
		return redirect()->route('building-type.index')->with('success', 'Building type deleted successfully.');
		
	}
}
