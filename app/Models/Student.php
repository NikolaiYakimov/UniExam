<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $array)
 */
class Student extends Authenticatable
{


   use HasFactory;
   protected $fillable = ['first_name', 'second_name','last_name','faculty_number','major','email','phone','username','password'];
   protected $hidden = ['password'];

   public function registrations(): HasMany
   {
       return $this->hasMany(ExamRegistration::class);
   }

}
