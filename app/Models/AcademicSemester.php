<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $start_date
 * @property string $end_date
 * @property int $is_current
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AcademicSemester newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AcademicSemester newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AcademicSemester query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AcademicSemester whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AcademicSemester whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AcademicSemester whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AcademicSemester whereIsCurrent($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AcademicSemester whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AcademicSemester whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|AcademicSemester whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class AcademicSemester extends Model
{
    protected $fillable = ['name','start_date','end_date','is_current'];
}
