<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class EventsAttendant extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'events_attendants';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const ENTITY_SELECT = [
        'ICBF' => 'ICBF',
        'MEN'  => 'MEN',
        'Otro' => 'Otro',
    ];

    protected $fillable = [
        'name',
        'last_name',
        'documenttype',
        'document',
        'department_id',
        'city_id',
        'entity',
        'phone',
        'email',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
