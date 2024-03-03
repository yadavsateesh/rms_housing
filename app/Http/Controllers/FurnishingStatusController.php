<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FurnishingStatus;
use DataTables;

class FurnishingStatusController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index()
    {
		return view('admin.master_property_data.furnishing_status.list');
    }
	
	public function furnishingStatuslist()
    {
        $get_furnishing_status = FurnishingStatus::get();
		
        return datatables()->of($get_furnishing_status)
			->addIndexColumn()
			->addColumn('action', function($data){
				return '
				<a href="' . route('furnishing-status.edit',$data->id) . '" class="icon__1"><i class="fa fa-edit"></i></a>
				<a href="' . route('furnishing-status.delete',$data->id) . '" class="icon__2" onClick="return confirm_click()"><i class="fa fa-trash-alt"></i></a>';
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
		return view('admin.master_property_data.furnishing_status.create');
    }
	
	public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
        ]);
		
		$furnishing_status = new FurnishingStatus();
		$furnishing_status->title = $request->title;
		$furnishing_status->save();
		
		return redirect()->route('furnishing-status.index')->with('success', 'Furnishing status added successfully.');
    }
	
	public function edit(FurnishingStatus $furnishing_status)
    {
        return view('admin.master_property_data.furnishing_status.edit', compact('furnishing_status'));
    }
	
	public function update(Request $request, FurnishingStatus $furnishing_status)
    {
        $data = $request->validate([
            'title' => 'required',
			'status' => 'required',
        ]);
		
        $furnishing_status = FurnishingStatus::find($furnishing_status->id);
		$furnishing_status->title = $request->title;
		$furnishing_status->status = $request->status;
		$furnishing_status->save();
		
		return redirect()->route('furnishing-status.index')->with('success', 'Furnishing status updated successfully.');
    }
	
	public function delete($id)
	{
		$furnishing_status = FurnishingStatus::find($id);
		$furnishing_status->delete();
		
		return redirect()->route('furnishing-status.index')->with('success', 'Furnishing status deleted successfully.');
		
	}
}
