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
    protected $fillable = [ 'user_id', 'exam_id', 'stripe_payment_id','amount', 'currency', 'status', 'payment_date'];

    public function user():belongsTo{
        return $this->belongsTo(User::class);
    }
    public function exam():belongsTo{
        return $this->belongsTo(Exam::class);
    }

    public function registration():hasOne
    {
        return $this->hasOne(ExamRegistration::class);
    }

}
