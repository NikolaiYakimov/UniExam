<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 */
class Exam extends Model
{

    use HasFactory;

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
    protected $fillable = ['teacher_id', 'subject_id','hall_id','start_time','end_time','max_students','exam_type','price'];

    public function hall(): BelongsTo
    {
        return $this->belongsTo(ExamHall::class, 'hall_id',);
    }

    public function teacher():belongsTo{
        return $this->belongsTo(Teacher::class);
    }
    public function subject():belongsTo{
       return $this->belongsTo(Subject::class);
    }

    public function registrations():hasMany{
        return $this->hasMany(ExamRegistration::class);
    }

    //Return the remaining slots for the exam
    public function remainingSlots(){
        return $this->max_students-$this->registrations()->count();
    }
}
