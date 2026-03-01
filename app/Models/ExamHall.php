<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 * @property int $id
 * @property string $name
 * @property int $capacity
 * @property string $opening_time
 * @property string $closing_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Exam> $exams
 * @property-read int|null $exams_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamHall newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamHall newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamHall query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamHall whereCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamHall whereClosingTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamHall whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamHall whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamHall whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamHall whereOpeningTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamHall whereUpdatedAt($value)
 * @mixin \Eloquent
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

    public function exams(): HasMany{
        return $this->HasMany(Exam::class,'hall_id');
    }
}
