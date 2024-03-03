<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\CmsPage;
use DataTables;

class CmsPageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
	
	public function index()
    {
		return view('admin.cms_page.list');
    }
	
	public function cmsPagelist()
    {
        $get_cmspages = CmsPage::get();
		
        return datatables()->of($get_cmspages)
			->addIndexColumn()
			->addColumn('action', function($data){
				return '
				<a href="' . route('cmspage.edit',$data->id) . '" class="icon__1"><i class="fa fa-edit"></i></a>
				<a href="' . route('cmspage.show',$data->id) . '" class="icon__3"><i class="fa fa-eye"></i></a>';
			})
			->editColumn('description', function($data){
				$description = strip_tags($data->description); 
				if(strlen($description) > 44)
				{
					$description = substr($description, 0, 44).'...';
				}
				return $description;
			})
			->editColumn('created_at', function($data){
				return date('Y-m-d', strtotime($data->created_at));
			})
			->rawColumns(['action'])
			->make(true);
	}
	public function create()
    {
		//
    }
	
	public function store(Request $request)
    {
       //
    }
	
	public function edit(CmsPage $cmspage)
	{
		 return view('admin.cms_page.edit', compact('cmspage'));
	}

	public function update(Request $request, CmsPage $cmspage)
    {
        $data = $request->validate([
            'title' => 'required',
			'status' => 'required',
        ]);
	
        $cmspage = CmsPage::find($cmspage->id);
		$cmspage->title = $request->title;
		$cmspage->description = $request->description;
		$cmspage->status = $request->status;
		$cmspage->save();
		
		return redirect()->route('cmspage.index')->with('success', 'Cmspage updated successfully.');
    }
	
	public function show(CmsPage $cmspage)
	{
		return view('admin.cms_page.view', compact('cmspage'));
	}
}
