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
                        $query->where('name', 'ilike', "%$search%")
                            ->orWhere('location', 'ilike', "%$search%")
                            ->orWhere('email', 'ilike', "%$search%")
                            ->orWhere('tag_number', 'ilike', "%$search%");
                    })
                        ->orWhere('status', 'ilike', "%$search%");
                });
            })
            ->orderBy($sortCol, $dir);
    }

}
