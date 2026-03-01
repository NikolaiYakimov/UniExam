<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
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
	class AcademicSemester extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Administrator whereUserId($value)
 * @mixin \Eloquent
 */
	class Administrator extends \Eloquent {}
}

namespace App\Models{
/**
 * @method static create(array $array)
 * @property int $id
 * @property int $teacher_id
 * @property int $subject_id
 * @property int $hall_id
 * @property \Illuminate\Support\Carbon $start_time
 * @property \Illuminate\Support\Carbon $end_time
 * @property int $max_students
 * @property string $exam_type
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ExamHall $hall
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExamRegistration> $registrations
 * @property-read int|null $registrations_count
 * @property-read \App\Models\Subject $subject
 * @property-read \App\Models\Teacher $teacher
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereEndTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereExamType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereHallId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereMaxStudents($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereStartTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereSubjectId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereTeacherId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Exam whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Exam extends \Eloquent {}
}

namespace App\Models{
/**
 * @method static create(array $array)
 * @property int $id
 * @property string $name
 * @property int $capacity
 * @property string $opening_time
 * @property string $closing_time
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Exam> $exams
 * @property-read int|null $exams_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamHall newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamHall newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamHall query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamHall whereCapacity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamHall whereClosingTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamHall whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamHall whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamHall whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamHall whereOpeningTime($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamHall whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ExamHall extends \Eloquent {}
}

namespace App\Models{
/**
 * @method static truncate()
 * @method static create(int[] $array)
 * @property int $id
 * @property int $student_id
 * @property int $exam_id
 * @property float|null $grade
 * @property bool $is_walk_in
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Exam $exam
 * @property-read \App\Models\Payment|null $payment
 * @property-read \App\Models\Student $student
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRegistration newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRegistration newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRegistration query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRegistration whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRegistration whereExamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRegistration whereGrade($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRegistration whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRegistration whereIsWalkIn($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRegistration whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|ExamRegistration whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ExamRegistration extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Specialty> $specialties
 * @property-read int|null $specialties_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Student> $students
 * @property-read int|null $students_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faculty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faculty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faculty query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faculty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faculty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faculty whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Faculty whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Faculty extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property int $specialty_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Specialty $specialty
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Student> $students
 * @property-read int|null $students_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Group newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Group newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Group query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Group whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Group whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Group whereSpecialtyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Group whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Group extends \Eloquent {}
}

namespace App\Models{
/**
 * @method static create(array $array)
 * @property int $id
 * @property int $student_id
 * @property int $exam_registration_id
 * @property string|null $stripe_payment_id
 * @property numeric $amount
 * @property string $currency
 * @property string|null $status
 * @property string|null $payment_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\ExamRegistration $registration
 * @property-read \App\Models\Student $student
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereExamRegistrationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment wherePaymentDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereStripePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereStudentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Payment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property int $faculty_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Faculty $faculty
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Group> $groups
 * @property-read int|null $groups_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Student> $students
 * @property-read int|null $students_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read int|null $subjects_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Teacher> $teachers
 * @property-read int|null $teachers_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Specialty whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Specialty extends \Eloquent {}
}

namespace App\Models{
/**
 * @method static create(array $array)
 * @property int $id
 * @property int $user_id
 * @property string $faculty_number
 * @property int $semester
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $specialty_id
 * @property int|null $group_id
 * @property int|null $faculty_id
 * @property-read \App\Models\Faculty|null $faculty
 * @property-read \App\Models\Group|null $group
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Payment> $payments
 * @property-read int|null $payments_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\ExamRegistration> $registrations
 * @property-read int|null $registrations_count
 * @property-read \App\Models\Specialty|null $specialty
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read int|null $subjects_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereFacultyNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereGroupId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereSemester($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereSpecialtyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Student whereUserId($value)
 * @mixin \Eloquent
 */
	class Student extends \Eloquent {}
}

namespace App\Models{
/**
 * @method static create(array $array)
 * @property int $id
 * @property string $subject_name
 * @property string $description
 * @property int $semester
 * @property numeric $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Exam> $exams
 * @property-read int|null $exams_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Specialty> $specialties
 * @property-read int|null $specialties_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Student> $students
 * @property-read int|null $students_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Teacher> $teachers
 * @property-read int|null $teachers_count
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject whereSemester($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject whereSubjectName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Subject whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Subject extends \Eloquent {}
}

namespace App\Models{
/**
 * @method static create(string[] $array)
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property int|null $faculty_id
 * @property int|null $specialty_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Exam> $exams
 * @property-read int|null $exams_count
 * @property-read \App\Models\Faculty|null $faculty
 * @property-read \App\Models\Specialty|null $specialty
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read int|null $subjects_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereFacultyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereSpecialtyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Teacher whereUserId($value)
 * @mixin \Eloquent
 */
	class Teacher extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $first_name
 * @property string $second_name
 * @property string $last_name
 * @property string $phone
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $role
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Administrator|null $administrator
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\Student|null $student
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Subject> $subjects
 * @property-read int|null $subjects_count
 * @property-read \App\Models\Teacher|null $teacher
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereSecondName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUsername($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

