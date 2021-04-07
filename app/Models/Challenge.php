<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use \DateTimeInterface;

class Challenge extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'challenges';

    protected $appends = [
        'capsule_file',
    ];

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

    const LIMIT_TIME_SELECT = [
        '24' => '24 horas',
        '48' => '48 horas',
        '72' => '72 horas',
    ];

    protected $fillable = [
        'name',
        'description',
        'goal',
        'capsule',
        'capsule_content',
        'challenge_action',
        'action_detail',
        'limit_time',
        'referencetype_id',
        'hours_adding',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const CHALLENGE_ACTION_SELECT = [
        'Leer'        => 'Leer',
        'Reflexionar' => 'Reflexionar',
        'Observar'    => 'Observar',
        'Investigar'  => 'Investigar',
        'Crear'       => 'Crear',
        'Compartir'   => 'Compartir',
        'Escribir'    => 'Escribir',
        'Pintar'      => 'Pintar',
        'Cantar'      => 'Cantar',
        'Contar'      => 'Contar',
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

    public function challengeChallengesUsers()
    {
        return $this->hasMany(ChallengesUser::class, 'challenge_id', 'id');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function getCapsuleFileAttribute()
    {
        return $this->getMedia('capsule_file')->last();
    }

    public function referencetype()
    {
        return $this->belongsTo(ReferenceType::class, 'referencetype_id');
    }

    public function points()
    {
        return $this->belongsToMany(PointsRule::class);
    }
}
