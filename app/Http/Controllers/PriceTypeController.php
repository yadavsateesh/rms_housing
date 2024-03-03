<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PriceType;
use DataTables;

class PriceTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index()
    {
		return view('admin.master_property_data.price_type.list');
    }
	
	public function priceTypelist()
    {
        $get_price_types = PriceType::get();
		
        return datatables()->of($get_price_types)
			->addIndexColumn()
			->addColumn('action', function($data){
				return '
				<a href="' . route('price-type.edit',$data->id) . '" class="icon__1"><i class="fa fa-edit"></i></a>
				<a href="' . route('price-type.delete',$data->id) . '" class="icon__2" onClick="return confirm_click()"><i class="fa fa-trash-alt"></i></a>';
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
		return view('admin.master_property_data.price_type.create');
    }
	
	public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
        ]);
		
		$price_type = new PriceType();
		$price_type->title = $request->title;
		$price_type->save();
		
		return redirect()->route('price-type.index')->with('success', 'Price type added successfully.');
    }
	
	public function edit(PriceType $price_type)
    {
        return view('admin.master_property_data.price_type.edit', compact('price_type'));
    }
	
	public function update(Request $request, PriceType $price_type)
    {
        $data = $request->validate([
            'title' => 'required',
			'status' => 'required',
        ]);
		
        $price_type = PriceType::find($price_type->id);
		$price_type->title = $request->title;
		$price_type->status = $request->status;
		$price_type->save();
		
		return redirect()->route('price-type.index')->with('success', 'Price type updated successfully.');
    }
	
	public function delete($id)
	{
		$price_type = PriceType::find($id);
		$price_type->delete();
		
		return redirect()->route('price-type.index')->with('success', 'Price type deleted successfully.');
		
	}
}
