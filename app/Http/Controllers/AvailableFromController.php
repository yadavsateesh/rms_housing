<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AvailableFrom;
use DataTables;

class AvailableFromController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index()
    {
		return view('admin.master_property_data.available_from.list');
    }
	
	public function availableFromlist()
    {
        $get_building_types = AvailableFrom::get();
		
        return datatables()->of($get_building_types)
			->addIndexColumn()
			->addColumn('action', function($data){
				return '
				<a href="' . route('available-from.edit',$data->id) . '" class="icon__1"><i class="fa fa-edit"></i></a>
				<a href="' . route('available-from.delete',$data->id) . '" class="icon__2" onClick="return confirm_click()"><i class="fa fa-trash-alt"></i></a>';
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
		return view('admin.master_property_data.available_from.create');
    }
	
	public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
        ]);
		
		$available_from = new AvailableFrom();
		$available_from->title = $request->title;
		$available_from->save();
		
		return redirect()->route('available-from.index')->with('success', 'Available from added successfully.');
    }
	
	public function edit(AvailableFrom $available_from)
    {
        return view('admin.master_property_data.available_from.edit', compact('available_from'));
    }
	
	public function update(Request $request, AvailableFrom $available_from)
    {
        $data = $request->validate([
            'title' => 'required',
			'status' => 'required',
        ]);
		
        $available_from = AvailableFrom::find($available_from->id);
		$available_from->title = $request->title;
		$available_from->status = $request->status;
		$available_from->save();
		
		return redirect()->route('available-from.index')->with('success', 'Available from updated successfully.');
    }
	
	public function delete($id)
	{
		$available_from = AvailableFrom::find($id);
		$available_from->delete();
		
		return redirect()->route('available-from.index')->with('success', 'Available from deleted successfully.');
	}
}
