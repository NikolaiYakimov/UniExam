<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


/**
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator whereUserId($value)
 * @mixin \Eloquent
 */
class Administrator extends Model
{
    use HasFactory;
    protected $fillable = ['user_id'];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}
