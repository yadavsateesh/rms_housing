<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Location;
use DataTables;

class LocationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index()
    {
		return view('admin.master_property_data.location.list');
    }
	
	public function locationList()
    {
        $get_location = Location::get();
		
        return datatables()->of($get_location)
			->addIndexColumn()
			->addColumn('action', function($data){
				return '
				<a href="' . route('location.edit',$data->id) . '" class="icon__1"><i class="fa fa-edit"></i></a>
				<a href="' . route('location.delete',$data->id) . '" class="icon__2" onClick="return confirm_click()"><i class="fa fa-trash-alt"></i></a>';
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
		return view('admin.master_property_data.location.create');
    }
	
	public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
        ]);
		
		$location = new Location();
		$location->title = $request->title;
		$location->save();
		
		return redirect()->route('location.index')->with('success', 'Location added successfully.');
    }
	
	public function edit(Location $location)
    {
        return view('admin.master_property_data.location.edit', compact('location'));
    }
	
	public function update(Request $request, Location $location)
    {
        $data = $request->validate([
            'title' => 'required',
			'status' => 'required',
        ]);
		
        $location = Location::find($location->id);
		$location->title = $request->title;
		$location->status = $request->status;
		$location->save();
		
		return redirect()->route('location.index')->with('success', 'Location updated successfully.');
    }
	
	public function delete($id)
	{
		$location = Location::find($id);
		$location->delete();
		
		return redirect()->route('location.index')->with('success', 'Location deleted successfully.');
		
	}
}
