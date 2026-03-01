<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 * @property int $id
 * @property int $teacher_id
 * @property int $subject_id
 * @property int $hall_id
 * @property \Illuminate\Support\Carbon $start_time
 * @property \Illuminate\Support\Carbon $end_time
 * @property int $max_students
 * @property string $exam_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ExamHall $hall
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExamRegistration> $registrations
 * @property-read int|null $registrations_count
 * @property-read \App\Models\Subject $subject
 * @property-read \App\Models\Teacher $teacher
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereExamType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereHallId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereMaxStudents($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Exam extends Model
{

    use HasFactory;

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
    protected $fillable = ['teacher_id', 'subject_id','hall_id','start_time','end_time','max_students','exam_type'];

    public function hall(): BelongsTo
    {
        return $this->belongsTo(ExamHall::class, 'hall_id');
    }

    public function teacher():BelongsTo{
        return $this->belongsTo(Teacher::class);
    }
    public function subject():BelongsTo{
       return $this->belongsTo(Subject::class);
    }

    public function registrations():HasMany{
        return $this->hasMany(ExamRegistration::class);
    }

    //Return the remaining slots for the exam
//    public function remainingSlots(){
//        return $this->max_students-$this->registrations()->count();
//    }
    public function remainingSlots(){
        $registered=$this->registrations()->count();
        //Allow 10 % overflow for the exam
//        $maxAllowed=$this->max_students+ceil($this->max_students*0.1);
//        $maxAllowed=$this->max_students-
//        if($registered >= $maxAllowed){
//            return 0;
//        }
//        return $maxAllowed-$registered;
        return $this->max_students-$registered;
    }

    public function hasAvailableSlots(): bool
    {
        return $this->remainingSlots()>0;
    }
}

