<?php

namespace App\Models;

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
    //
}
