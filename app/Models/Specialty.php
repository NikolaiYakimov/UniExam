<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
}
