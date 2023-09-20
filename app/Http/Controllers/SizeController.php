<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Unit;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Validator;

class SizeController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Size::select('*');
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" style="color :#4B49AC;" class="editUnit" data-id="'.$row->id.'"><i class="fa fa-pencil aria-hidden="true""></i></a>&nbsp;&nbsp;<a href="'.route("size.delete",$row->id).'" style="color :#4B49AC;"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('size.index');
    }

    public function store(Request $request){
        try {
            Validator::make($request->all(), [
                'title' => 'required',
            ]);
            $msg = "";
            if(isset($request->size_id)){
                $edit = Size::find($request->size_id);
                $edit->title = $request->title;
                $edit->save();
                $msg = 'Size updated successfully.';
            }else{
                Size::create([
                    'title' => $request->title,
                    'status' => 1,
                ]);
                $msg = 'Size created successfully.';
            }
            return redirect()->route('size.index')
            ->with('success', $msg);
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function edit($id){
        $edit = Size::where('id',$id)->first();
        return $edit;
    }

    public function destroy($id)
    {
        Size::find($id)->delete();
        return redirect()->route('size.index')->with('success','Colour Size successfully');
    }

}
