<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 */
class ExamHall extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'capacity',
        'opening_time',
        'closing_time',
    ];

    public function exam(): BelongsTo{
        return $this->belongsTo(Exam::class);
    }
}
