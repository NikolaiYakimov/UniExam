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
 * @property int $id
 * @property int $user_id
 * @property string $faculty_number
 * @property int $semester
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $specialty_id
 * @property int|null $group_id
 * @property int|null $faculty_id
 * @property-read \App\Models\Faculty|null $faculty
 * @property-read \App\Models\Group|null $group
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payment> $payments
 * @property-read int|null $payments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExamRegistration> $registrations
 * @property-read int|null $registrations_count
 * @property-read \App\Models\Specialty|null $specialty
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read int|null $subjects_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereFacultyNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereSemester($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereSpecialtyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereUserId($value)
 * @mixin \Eloquent
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

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }
}
