<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;


class Payment extends Model
{
    use HasFactory;
    protected $fillable = [ 'student_id', 'exam_id', 'amount', 'currency',
        'transaction_id', 'status', 'payment_date'];

    public function student():belongsTo{
        return $this->belongsTo(Student::class);
    }
    public function exam():belongsTo{
        return $this->belongsTo(Exam::class);
    }

    public function registration():hasOne
    {
        return $this->hasOne(ExamRegistration::class);
    }

}
