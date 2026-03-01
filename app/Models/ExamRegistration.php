<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static truncate()
 * @method static create(int[] $array)
 * @property int $id
 * @property int $student_id
 * @property int $exam_id
 * @property float|null $grade
 * @property bool $is_walk_in
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Exam $exam
 * @property-read \App\Models\Payment|null $payment
 * @property-read \App\Models\Student $student
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRegistration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRegistration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRegistration query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRegistration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRegistration whereExamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRegistration whereGrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRegistration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRegistration whereIsWalkIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRegistration whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRegistration whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ExamRegistration extends Model
{

    use HasFactory;
    protected $fillable = ['student_id','exam_id','grade','is_walk_in',

    ];
    protected $casts = [
        'grade' => 'float',
        'is_walk_in' => 'boolean',
    ];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    public function payment():HasOne{
        return $this->HasOne(Payment::class);
    }
}
