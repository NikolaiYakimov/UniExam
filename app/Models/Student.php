<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 */
class Student extends Model
{


   use HasFactory;
   protected $fillable = ['user_id','faculty_number','faculty_id','specialty_id','semester','group_id'];


   public function user():BelongsTo
   {
       return $this->BelongsTo(  User::class);
   }
   public function registrations(): HasMany
   {
       return $this->hasMany(ExamRegistration::class);
   }

   public function faculty():BelongsTo
   {
       return $this->belongsTo(Faculty::class);
   }

   public function specialty():BelongsTo{
        return $this->belongsTo(Specialty::class);
   }
   public function group():BelongsTo{
       return $this->belongsTo(Group::class);
   }

    public function subjects():BelongsToMany
    {
        return $this->belongsToMany(Subject::class,'subject_student')
            ->withPivot('has_attestation');
    }

    public function hasAttestationForSubject(int $subjectId): bool{
        return $this->subjects()->where('subject_id',$subjectId)->wherePivot('has_attestation',true)->exists();
    }

}
