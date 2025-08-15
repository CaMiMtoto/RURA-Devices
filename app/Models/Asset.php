<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    public function confirmedAssets()
    {
        return $this->hasMany(ConfirmedAsset::class,'asset_id');
    }
    public function confirmed()
    {
        return $this->hasOne(ConfirmedAsset::class,'asset_id');
    }
}
