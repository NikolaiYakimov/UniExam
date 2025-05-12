<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static truncate()
 * @method static create(int[] $array)
 */
class ExamRegistration extends Model
{

    use HasFactory;
    protected $fillable = ['student_id','exam_id','payment_id'];

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    public function payment():BelongsTo{
        return $this->belongsTo(Payment::class);
    }
}
