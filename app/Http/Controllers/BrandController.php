<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Unit;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Brand::select('*');
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" style="color :#4B49AC;" class="editUnit" data-id="'.$row->id.'"><i class="fa fa-pencil aria-hidden="true""></i></a>&nbsp;&nbsp;<a href="'.route("brand.delete",$row->id).'" style="color :#4B49AC;"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('brand.index');
    }

    public function store(Request $request){
        try {
            Validator::make($request->all(), [
                'title' => 'required',
            ]);
            $msg = "";
            if(isset($request->brand_id)){
                $edit = Brand::find($request->brand_id);
                $edit->title = $request->title;
                $edit->save();
                $msg = 'Colour Brand successfully.';
            }else{
                Brand::create([
                    'title' => $request->title,
                    'status' => 1,
                ]);
                $msg = 'Colour Brand successfully.';
            }
            return redirect()->route('brand.index')
            ->with('success', $msg);
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function edit($id){
        $edit = Brand::where('id',$id)->first();
        return $edit;
    }

    public function destroy($id)
    {
        Brand::find($id)->delete();
        return redirect()->route('brand.index')->with('success','Brand deleted successfully');
    }

}
