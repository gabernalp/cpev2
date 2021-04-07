<?php

namespace App\Models;

use App\Traits\Auditable;
use App\Traits\MultiTenantModelTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \DateTimeInterface;

class ChallengesUser extends Model implements HasMedia
{
    use SoftDeletes, MultiTenantModelTrait, InteractsWithMedia, Auditable, HasFactory;

    protected $appends = [
        'file',
    ];

    public $table = 'challenges_users';

    protected $dates = [
        'created_at',
        'deadline',
        'updated_at',
        'deleted_at',
    ];

    const STATUS_SELECT = [
        'Enviado'   => 'Enviado',
        'Entregado' => 'Entregado',
        'Abandono'  => 'Abandono',
    ];

    protected $fillable = [
        'challenge_id',
        'user_id',
        'courseschedule_id',
        'referencetype_id',
        'reference_text',
        'reference_media',
        'status',
        'created_at',
        'deadline',
        'updated_at',
        'deleted_at',
        'created_by_id',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function challenge()
    {
        return $this->belongsTo(Challenge::class, 'challenge_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function courseschedule()
    {
        return $this->belongsTo(CourseSchedule::class, 'courseschedule_id');
    }

    public function referencetype()
    {
        return $this->belongsTo(ReferenceType::class, 'referencetype_id');
    }

    public function getFileAttribute()
    {
        return $this->getMedia('file')->last();
    }

    public function getDeadlineAttribute($value)
    {
        return $value ? Carbon::parse($value)->format(config('panel.date_format')) : null;
    }

    public function setDeadlineAttribute($value)
    {
        $this->attributes['deadline'] = $value ? Carbon::createFromFormat(config('panel.date_format'), $value)->format('Y-m-d') : null;
    }

    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }
}
