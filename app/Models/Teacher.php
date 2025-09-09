<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @method static create(string[] $array)
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

    public function getExamsCountAttribute()
    {
        return $this->exams()->count();
    }
}
