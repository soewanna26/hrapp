<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    public function index(Request $request)
    {
        $positions = Position::latest();

        if (!empty($request->get('keyword'))) {
            $positions = $positions->where('name', 'like', '%' . $request->get('keyword') . '%');
        }
        $positions = $positions->paginate(10);
        return view('admin.position.index', compact('positions'));
    }
    public function create()
    {
        return view('admin.position.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:positions',
        ]);
        if ($validator->passes()) {
            $position = new Position();
            $position->name = $request->name;
            $position->save();

            $request->session()->flash('success', 'Position added successfully');

            return response()->json([
                'status' => true,
                'message' => "Position Create Successfully"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit(Request $request, $positionId)
    {
        $position = Position::find($positionId);
        if (empty($position)) {
            $request->session()->flash('error', 'Record Not Found');
            return redirect()->route('positions.index');
        }
        return view('admin.position.edit', compact('position'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $positionId)
    {
        $position = Position::find($positionId);
        if (empty($position)) {
            $request->session()->flash('error', 'Position Not Found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Position not found',
            ]);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:positions,name,' . $position->id . ',id',
        ]);
        if ($validator->passes()) {
            $position->name = $request->name;
            $position->save();

            $request->session()->flash('success', 'Position Updated successfully');

            return response()->json([
                'status' => true,
                'message' => "Position Update Successfully"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $positionId)
    {
        $position = Position::find($positionId);
        if (empty($position)) {
            $request->session()->flash('error', 'Position Not Found');
            return response()->json([
                'status' => 'error',
                'message' => 'Position Not Found',
            ]);
        }
        $position->delete();

        $request->session()->flash('success', 'Position deleted successfully');
        return response()->json([
            'status' => 'success',
            'message' => 'Position deleted successfully',
        ]);
    }
}
