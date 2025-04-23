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

    protected $fillable = ['teacher_id', 'subject_id', 'exam_date','exam_hall','max_students','exam_type'];

    

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
