<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class Course extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'courses';

    public static $searchable = [
        'name',
        'description',
        'goal',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'goal',
        'support_required',
        'hours',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function coursesChallenges()
    {
        return $this->belongsToMany(Challenge::class);
    }

    public function associated_processes()
    {
        return $this->belongsToMany(BackgroundProcess::class);
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function focalizacion_territorials()
    {
        return $this->belongsToMany(Department::class);
    }

    public function operators()
    {
        return $this->belongsToMany(Operator::class);
    }

    public function references()
    {
        return $this->belongsToMany(ReferenceObject::class);
    }

    public function courseshooks()
    {
        return $this->belongsToMany(CoursesHook::class);
    }
}
