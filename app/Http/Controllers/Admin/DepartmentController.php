<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::latest();

        if (!empty($request->get('keyword'))) {
            $departments = $departments->where('name', 'like', '%' . $request->get('keyword') . '%');
        }
        $departments = $departments->paginate(10);
        return view('admin.department.index', compact('departments'));
    }
    public function create()
    {
        return view('admin.department.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:departments',
        ]);
        if ($validator->passes()) {
            $department = new department();
            $department->name = $request->name;
            $department->save();

            $request->session()->flash('success', 'Department added successfully');

            return response()->json([
                'status' => true,
                'message' => "Department Create Successfully"
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }

    public function edit(Request $request, $departmentId)
    {
        $department = Department::find($departmentId);
        if (empty($department)) {
            $request->session()->flash('error', 'Record Not Found');
            return redirect()->route('departments.index');
        }
        return view('admin.department.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $departmentId)
    {
        $department = Department::find($departmentId);
        if (empty($department)) {
            $request->session()->flash('error', 'Department Not Found');
            return response()->json([
                'status' => false,
                'notFound' => true,
                'message' => 'Department not found',
            ]);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:departments,name,' . $department->id . ',id',
        ]);
        if ($validator->passes()) {
            $department->name = $request->name;
            $department->save();

            $request->session()->flash('success', 'Department Updated successfully');

            return response()->json([
                'status' => true,
                'message' => "Department Update Successfully"
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
    public function destroy(Request $request, $departmentId)
    {
        $department = Department::find($departmentId);
        if (empty($department)) {
            $request->session()->flash('error', 'Department Not Found');
            return response()->json([
                'status' => 'error',
                'message' => 'Department Not Found',
            ]);
        }
        $department->delete();

        $request->session()->flash('success', 'Department deleted successfully');
        return response()->json([
            'status' => 'success',
            'message' => 'department deleted successfully',
        ]);
    }
}
