<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use App\Traits\HasEncodedId;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Model;

//#[ScopedBy(ActiveScope::class)]
/**
 * 
 *
 * @property int $id
 * @property string $name
 * @property string|null $abbreviation
 * @property string|null $description
 * @property bool $is_active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobTitle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobTitle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobTitle query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobTitle whereAbbreviation($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobTitle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobTitle whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobTitle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobTitle whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobTitle whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|JobTitle whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class JobTitle extends Model
{
    use HasEncodedId;

    protected $casts=[
        'is_active'=>'boolean'
    ];
}
