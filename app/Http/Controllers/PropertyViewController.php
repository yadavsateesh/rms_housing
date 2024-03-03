<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PropertyView;
use DataTables;

class PropertyViewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index()
    {
		return view('admin.master_property_data.property_view.list');
    }
	
	public function propertyViewlist()
    {
        $get_property_views = PropertyView::get();
		
        return datatables()->of($get_property_views)
			->addIndexColumn()
			->addColumn('action', function($data){
				return '
				<a href="' . route('property-view.edit',$data->id) . '" class="icon__1"><i class="fa fa-edit"></i></a>
				<a href="' . route('property-view.delete',$data->id) . '" class="icon__2" onClick="return confirm_click()"><i class="fa fa-trash-alt"></i></a>';
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
		return view('admin.master_property_data.property_view.create');
    }
	
	public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
        ]);
		
		$property_view = new PropertyView();
		$property_view->title = $request->title;
		$property_view->save();
		
		return redirect()->route('property-view.index')->with('success', 'Property view added successfully.');
    }
	
	public function edit(PropertyView $property_view)
    {
        return view('admin.master_property_data.property_view.edit', compact('property_view'));
    }
	
	public function update(Request $request, PropertyView $property_view)
    {
        $data = $request->validate([
            'title' => 'required',
			'status' => 'required',
        ]);
		
        $property_view = PropertyView::find($property_view->id);
		$property_view->title = $request->title;
		$property_view->status = $request->status;
		$property_view->save();
		
		return redirect()->route('property-view.index')->with('success', 'Property view updated successfully.');
    }
	
	public function delete($id)
	{
		$property_view = PropertyView::find($id);
		$property_view->delete();
		
		return redirect()->route('property-view.index')->with('success', 'Property view deleted successfully.');
		
	}
}
