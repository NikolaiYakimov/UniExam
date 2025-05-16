<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
   protected $fillable = ['user_id','faculty_number','faculty','major','semester','group'];


   public function user():BelongsTo
   {
       return $this->belongsTo(  User::class);
   }
   public function registrations(): HasMany
   {
       return $this->hasMany(ExamRegistration::class);
   }

}
