<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 */
class Subject extends Model
{


    use HasFactory;

    protected $fillable=['subject_name','description','semester','price'];

    protected $attributes = [
        'price'=>40.00,
    ];

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class, 'subject_specialty');
    }

    public function students(){
        return $this->belongsToMany(Student::class, 'subject_student')->withPivot('has_attestation');
    }

}
