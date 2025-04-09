<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(string[] $array)
 */
class Teacher extends Model
{
  use HasFactory;

  protected $fillable = ['first_name','second_name' ,'last_name', 'title', 'email', 'phone'];

  public function exams(): HasMany
  {
      return $this->hasMany(Exam::class);
  }
    public function setFirstNameAttribute(string $firstName): void
    {
        $this->attributes['first_name'] = ucfirst($firstName);
    }

    public function setSecondNameAttribute(string $secondName): void
    {
        $this->attributes['second_name'] = ucfirst($secondName);
    }

    public function setLastNameAttribute(string $lastName): void
    {
        $this->attributes['last_name'] = ucfirst($lastName);
    }
}
