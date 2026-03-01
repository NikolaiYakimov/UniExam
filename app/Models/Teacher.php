<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @method static create(string[] $array)
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property int|null $faculty_id
 * @property int|null $specialty_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Exam> $exams
 * @property-read int|null $exams_count
 * @property-read \App\Models\Faculty|null $faculty
 * @property-read \App\Models\Specialty|null $specialty
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read int|null $subjects_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereSpecialtyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereUserId($value)
 * @mixin \Eloquent
 */
class Teacher extends Model
{
  use HasFactory;

  protected $fillable = [ 'user_id','title','specialty_id','faculty_id'];




  public function exams(): HasMany
  {
      return $this->hasMany(Exam::class);
  }
  public function user(): BelongsTo{
      return $this->BelongsTo(User::class);
  }
    public function faculty():BelongsTo
    {
        return $this->belongsTo(Faculty::class);
    }

    public function specialty():BelongsTo{
        return $this->belongsTo(Specialty::class);
    }

    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_teacher');
    }

    public function getExamsCountAttribute()
    {
        return $this->exams()->count();
    }
}
