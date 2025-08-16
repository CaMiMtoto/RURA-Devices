<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string|null $number
 * @property string $name
 * @property string|null $capitalization_date
 * @property string|null $cost
 * @property string|null $tag_number
 * @property string|null $location
 * @property string|null $email
 * @property string|null $status
 * @property string|null $comment
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ConfirmedAsset|null $confirmed
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ConfirmedAsset> $confirmedAssets
 * @property-read int|null $confirmed_assets_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereCapitalizationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereCost($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereLocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereTagNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Asset whereUpdatedAt($value)
 * @mixin \Eloquent
 */
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
