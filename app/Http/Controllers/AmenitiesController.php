<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Amenities;
use DataTables;

class AmenitiesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index()
    {
		return view('admin.master_property_data.amenities.list');
    }
	
	public function AmenitiesList()
    {
        $get_amenities = Amenities::get();
		
        return datatables()->of($get_amenities)
			->addIndexColumn()
			->addColumn('action', function($data){
				return '
				<a href="' . route('amenities.edit',$data->id) . '" class="icon__1"><i class="fa fa-edit"></i></a>
				<a href="' . route('amenities.delete',$data->id) . '" class="icon__2" onClick="return confirm_click()"><i class="fa fa-trash-alt"></i></a>';
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
		return view('admin.master_property_data.amenities.create');
    }
	
	public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
        ]);
		
		$amenities = new Amenities();
		$amenities->title = $request->title;
		$amenities->save();
		
		return redirect()->route('amenities.index')->with('success', 'Amenities added successfully.');
    }
	
	public function edit($amenitie_id)
	{
		$amenities = Amenities::find($amenitie_id);
		return view('admin.master_property_data.amenities.edit', compact('amenities'));
	}

	public function update(Request $request, $amenities_id)
    {
        $data = $request->validate([
            'title' => 'required',
			'status' => 'required',
        ]);
	
        $amenities = Amenities::find($amenities_id);
		$amenities->title = $request->title;
		$amenities->status = $request->status;
		$amenities->save();
		
		return redirect()->route('amenities.index')->with('success', 'Amenities updated successfully.');
    }
	
	public function delete($id)
	{
		$amenities = Amenities::find($id);
		$amenities->delete();
		
		return redirect()->route('amenities.index')->with('success', 'Amenities deleted successfully.');
		
	}
}
