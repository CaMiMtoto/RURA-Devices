<?php

namespace App\Models;

use App\Traits\HasStatusColor;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $asset_id
 * @property int $confirmed_by
 * @property string $status
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConfirmedAsset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConfirmedAsset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConfirmedAsset query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConfirmedAsset whereAssetId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConfirmedAsset whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConfirmedAsset whereConfirmedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConfirmedAsset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConfirmedAsset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConfirmedAsset whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ConfirmedAsset whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ConfirmedAsset extends Model
{
    use HasStatusColor;
    protected $appends= ['real_status', 'status_color'];
    public function asset(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Asset::class, 'asset_id');
    }
    public function confirmedBy(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    public function getRealStatusAttribute(): string
    {
//        remove _ from status and convert to lowercase
        return ucwords(str_replace('_', ' ', $this->status));
    }
}
