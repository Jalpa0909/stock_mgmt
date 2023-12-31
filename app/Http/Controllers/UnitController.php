<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Unit::select('*');
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" style="color :#4B49AC;" class="editUnit" data-id="'.$row->id.'"><i class="fa fa-pencil aria-hidden="true""></i></a>&nbsp;&nbsp;<a href="'.route("unit.delete",$row->id).'" style="color :#4B49AC;"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('units.index');
    }

    public function store(Request $request){
        try {
            Validator::make($request->all(), [
                'title' => 'required',
            ]);
            $msg = "";
            if(isset($request->unit_id)){
                $edit = Unit::find($request->unit_id);
                $edit->title = $request->title;
                $edit->save();
                $msg = 'Unit updated successfully.';
            }else{
                Unit::create([
                    'title' => $request->title,
                    'status' => 1,
                ]);
                $msg = 'Unit created successfully.';
            }
            return redirect()->route('unit.index')
            ->with('success', $msg);
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function edit($id){
        $edit = Unit::where('id',$id)->first();
        return $edit;
    }

    public function destroy($id)
    {
        Unit::find($id)->delete();
        return redirect()->route('unit.index')->with('success','Unit deleted successfully');
    }

}
