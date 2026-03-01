<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int $id
 * @property string $name
 * @property int $faculty_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Faculty $faculty
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Group> $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Student> $students
 * @property-read int|null $students_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read int|null $subjects_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Teacher> $teachers
 * @property-read int|null $teachers_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Specialty extends Model
{
    use HasFactory;

    protected $fillable = ['name','faculty_id'];

    public function faculty():BelongsTo{
        return $this->belongsTo(Faculty::class);
    }

    public function groups():HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function students():HasMany{
        return $this->hasMany(Student::class);
    }

    public function subjects():BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_specialty');
    }
    public function teachers():hasMany{
        return $this->hasMany(Teacher::class);
    }
}
