<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AgeOfProperty;
use DataTables;

class AgeOfPropertyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index()
    {
		return view('admin.master_property_data.age_of_property.list');
    }
	
	public function ageOfpropertyList()
    {
        $get_age_of_property = AgeOfProperty::get();
		
        return datatables()->of($get_age_of_property)
			->addIndexColumn()
			->addColumn('action', function($data){
				return '
				<a href="' . route('age-of-property.edit',$data->id) . '" class="icon__1"><i class="fa fa-edit"></i></a>
				<a href="' . route('age-of-property.delete',$data->id) . '" class="icon__2" onClick="return confirm_click()"><i class="fa fa-trash-alt"></i></a>';
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
		return view('admin.master_property_data.age_of_property.create');
    }
	
	public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
        ]);
		
		$age_of_property = new AgeOfProperty();
		$age_of_property->title = $request->title;
		$age_of_property->save();
		
		return redirect()->route('age-of-property.index')->with('success', 'Age of property added successfully.');
    }
	
	public function edit(AgeOfProperty $age_of_property)
    {
        return view('admin.master_property_data.age_of_property.edit', compact('age_of_property'));
    }
	
	public function update(Request $request, AgeOfProperty $age_of_property)
    {
        $data = $request->validate([
            'title' => 'required',
			'status' => 'required',
        ]);
		
        $age_of_property = AgeOfProperty::find($age_of_property->id);
		$age_of_property->title = $request->title;
		$age_of_property->status = $request->status;
		$age_of_property->save();
		
		return redirect()->route('age-of-property.index')->with('success', 'Age of property updated successfully.');
    }
	
	public function delete($id)
	{
		$age_of_property = AgeOfProperty::find($id);
		$age_of_property->delete();
		
		return redirect()->route('age-of-property.index')->with('success', 'Age of property deleted successfully.');
		
	}
}
