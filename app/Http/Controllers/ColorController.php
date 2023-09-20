<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Models\Unit;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Validator;

class ColorController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Color::select('*');
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" style="color :#4B49AC;" class="editUnit" data-id="'.$row->id.'"><i class="fa fa-pencil aria-hidden="true""></i></a>&nbsp;&nbsp;<a href="'.route("colour.delete",$row->id).'" style="color :#4B49AC;"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('colour.index');
    }

    public function store(Request $request){
        try {
            Validator::make($request->all(), [
                'title' => 'required',
            ]);
            $msg = "";
            if(isset($request->color_id)){
                $edit = Color::find($request->color_id);
                $edit->title = $request->title;
                $edit->save();
                $msg = 'Colour updated successfully.';
            }else{
                Color::create([
                    'title' => $request->title,
                    'status' => 1,
                ]);
                $msg = 'Colour created successfully.';
            }
            return redirect()->route('colour.index')
            ->with('success', $msg);
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function edit($id){
        $edit = Color::where('id',$id)->first();
        return $edit;
    }

    public function destroy($id)
    {
        Color::find($id)->delete();
        return redirect()->route('colour.index')->with('success','Colour deleted successfully');
    }

}
