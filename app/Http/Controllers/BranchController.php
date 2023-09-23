<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Exception;
use Illuminate\Support\Facades\Validator;

class BranchController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Branch::select('*');
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                $btn = '<a href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" style="color :#4B49AC;" class="editUnit" data-id="'.$row->id.'"><i class="fa fa-pencil aria-hidden="true""></i></a>&nbsp;&nbsp;<a href="'.route("branch.delete",$row->id).'" style="color :#4B49AC;"><i class="fa fa-trash"></i></a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('branch.index');
    }

    public function store(Request $request){
        try {
            Validator::make($request->all(), [
                'branch_name' => 'required',
                'branch_city' => 'required',
                'mobile_number' => 'required',
                // 'password' => 'required',
            ]);
            $msg = "";
            if(isset($request->branch_id)){
                $edit = Branch::find($request->branch_id);
                $edit->branch_name = $request->branch_name;
                $edit->branch_city = $request->branch_city;
                $edit->mobile_number = $request->mobile_number;
                $edit->save();
                $msg = 'Branch updated successfully.';
            }else{
                Branch::create([
                    'branch_name' => $request->branch_name,
                    'branch_city' => $request->branch_city,
                    'mobile_number' => $request->mobile_number,
                    'password' => Hash::make($request['password']),
                    'status' => 1,
                ]);
                $msg = 'Branch created successfully.';
            }
            return redirect()->route('branch.index')
            ->with('success', $msg);
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function edit($id){
        $edit = Branch::where('id',$id)->first();
        return $edit;
    }

    public function destroy($id)
    {
        Branch::find($id)->delete();
        return redirect()->route('branch.index')->with('success','Branch deleted successfully');
    }
}
