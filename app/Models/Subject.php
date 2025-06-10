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

    public function exams(): HasMany
    {
        return $this->hasMany(Exam::class);
    }
}
