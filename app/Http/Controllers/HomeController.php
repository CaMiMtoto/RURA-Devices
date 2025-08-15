<?php

namespace App\Http\Controllers;

use App\Constants\Permission;
use App\Models\Asset;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return redirect('admin/dashboard');
    }

    public function dashboard()
    {
        $baseQuery = Asset::query()->where('email', auth()->user()->email);

        $totalPendingConfirmations = (clone $baseQuery)
            ->whereDoesntHave('confirmedAssets')
            ->count();

        $totalConfirmedAssets = (clone $baseQuery)
            ->whereHas('confirmedAssets')
            ->count();

        $totalReceivedAssets = (clone $baseQuery)
            ->whereHas('confirmedAssets', function ($q) {
                $q->where('status', 'received');
            })
            ->count();

        $totalNotReceivedAssets = (clone $baseQuery)
            ->whereHas('confirmedAssets', function ($q) {
                $q->where('status', 'not_received');
            })
            ->count();

        return view('admin.dashboard', compact(
            'totalPendingConfirmations',
            'totalConfirmedAssets',
            'totalReceivedAssets',
            'totalNotReceivedAssets'
        ));
    }
}
