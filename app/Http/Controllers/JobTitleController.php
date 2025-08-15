<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\JobTitle;
use App\Models\Scopes\ActiveScope;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class JobTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     * @throws \Exception
     */
    public function index()
    {
        if (\request()->ajax()) {
            $data = JobTitle::query()->withoutGlobalScope(ActiveScope::class);
            return DataTables::of($data)
                ->addColumn('action', fn(JobTitle $item) => view('admin.job-titles.partials._actions', compact('item')))
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.job-titles.index');
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
            $department = JobTitle::query()->find($id);
            $department->update($data);
        } else {
            $department = JobTitle::query()->create($data);
        }
        return response()->json(['success' => true, 'department' => $department]);
    }

    /**
     * Display the specified resource.
     */
    public function show(JobTitle $jobTitle)
    {
        return $jobTitle;
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobTitle $jobTitle)
    {
        try {
            $jobTitle->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            info($e->getMessage());
            return response()->json(['success' => false, 'message' => 'Error while deleting department']);
        }
    }
}
