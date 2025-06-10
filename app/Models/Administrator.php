<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Administrator extends Model
{
    use HasFactory;
    protected $fillable = ['user_id'];

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class);
    }
}
