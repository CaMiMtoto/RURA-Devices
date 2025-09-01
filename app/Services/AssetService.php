<?php

namespace App\Services;

use App\Models\ConfirmedAsset;
use Illuminate\Database\Eloquent\Builder;

class AssetService
{
    public function getConfirmedAssetsBuilder(array $filters, string $sortCol, string $dir)
    {
        return ConfirmedAsset::query()
            ->with(['asset', 'confirmedBy'])
            ->when($filters['startDate'], fn($query, $startDate) => $query->whereDate('created_at', '>=', $startDate))
            ->when($filters['endDate'], fn($query, $endDate) => $query->whereDate('created_at', '<=', $endDate))
            ->when($filters['search'], function ($query, $search) {
                return $query->where(function (Builder $query) use ($search) {
                    $query->whereHas('asset', function ($query) use ($search) {
                        $query->where('name', 'like', "%$search%")
                            ->orWhere('location', 'like', "%$search%")
                            ->orWhere('email', 'like', "%$search%")
                            ->orWhere('tag_number', 'like', "%$search%");
                    })
                        ->orWhere('status', 'like', "%$search%");
                });
            })
            ->orderBy($sortCol, $dir);
    }

}
