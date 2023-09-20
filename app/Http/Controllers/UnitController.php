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

                $btn = "<a href='/unit/edit/".$row->id."' class='btn btn-primary data-toggle='modal' data-target='#exampleModal'>Edit</a>";
                // $btn = '<a href="#"
                // class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" onclick="editUnit('.$row->id.')">Edit</a>';

                //  // Delete Button
                //  $deleteButton = "<button class='btn btn-sm btn-danger deleteUser' data-id='".$row->id."'><i class='fa-solid fa-trash'></i></button>";

                //  return $updateButton." ".$deleteButton;
                // $btn = '<a href="{{ url("unit.edit") }}">Edit</a>';

                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('units.index');
    }

    public function store(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'title' => 'required',
            ]);
            Unit::create([
                'title' => $request->title,
                'status' => 1,
            ]);
            return redirect()->route('unit.index')
            ->with('success','Unit created successfully.');
        } catch (Exception $e) {
            return back()->withErrors($e->getMessage());
        }
    }

    public function edit($id){
        $edit = Unit::where('id',$id)->first();
        return view('units.index',compact('edit'));
    }

}
