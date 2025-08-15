<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Yajra\DataTables\Exceptions\Exception;

class AssetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Asset $asset)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asset $asset)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asset $asset)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asset $asset)
    {
        //
    }

    /**
     * @throws Exception
     */
    public function myAssets()
    {

        if (\request()->ajax()){
            $assets = Asset::query()
                ->where('email', '=',auth()->user()->email)
                ->whereDoesntHave('confirmedAssets');

            return datatables($assets)
                ->addColumn('actions', fn(Asset $asset) => view('admin.assets.partials.actions', compact('asset')))
                ->rawColumns(['actions'])
                ->toJson();
        }


        return view('admin.assets.my-assets');

    }

    public function confirmAssets(Request $request)
    {
        $data = $request->validate([
            'ids' => ['required', 'array'],
            'ids.*' => ['required', 'integer'],
            'status' => ['required', 'string', 'in:received,not_received'],
        ]);

        $assets = Asset::query()
            ->whereIn('id', $data['ids'])
            ->whereDoesntHave('confirmedAssets')
            ->get();
        if ($assets->isEmpty()) {
            if ($request->ajax()) {
                return response()->json(['message' => 'No assets found to confirm.'], 404);
            }
            return redirect()->back()->with('error', 'No assets found to confirm.');
        }
        foreach ($assets as $asset) {
            $asset->confirmedAssets()->create([
                'confirmed_by' => auth()->id(),
                'status' => $data['status'],
                'comment' => $request->input('comment', null),
            ]);
        }
        if ($request->ajax()) {
            return response()->json(['message' => 'Assets confirmed successfully.']);
        }
        return redirect()->back()->with('success', 'Assets confirmed successfully.');
    }
}
