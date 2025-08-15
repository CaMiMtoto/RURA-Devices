<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Scopes\ActiveScope;
use Illuminate\Http\Request;
use Yajra\DataTables\Exceptions\Exception;
use Yajra\DataTables\Facades\DataTables;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws Exception
     * @throws \Exception
     */
    public function index()
    {
        $departments = Department::query()
            ->withoutGlobalScope(ActiveScope::class)
            ->withCount('users');
        if (\request()->ajax()) {
            return DataTables::of($departments)
                ->addColumn('action', fn(Department $item) => view('admin.departments.partials._actions', compact('item')))
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.departments.index');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:255',
            'is_active' => ['required', 'boolean']
        ]);

        $id = $request->input('id');
        if ($id) {
            $department = Department::find($id);
            $department->update($data);
        } else {
            $department = Department::create($data);
        }
        return response()->json(['success' => true, 'department' => $department]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return $department;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        try {
            $department->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            info($e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error while deleting department']);
        }
    }
}
