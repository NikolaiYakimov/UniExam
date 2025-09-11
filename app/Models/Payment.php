<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


/**
 * @method static create(array $array)
 */
class Payment extends Model
{
    use HasFactory;
    protected $fillable = [ 'student_id', 'exam_registration_id', 'stripe_payment_id','amount', 'currency', 'status', 'payment_date'];

    public function student():BelongsTo{
        return $this->BelongsTo(Student::class);
    }
    public function registration():BelongsTo{
        return $this->BelongsTo(ExamRegistration::class,'exam_registration_id');
    }

}
