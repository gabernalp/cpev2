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

class CoursesHook extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'courses_hooks';

    protected $appends = [
        'file',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'description',
        'specific_category',
        'requirements',
        'link',
        'priorized',
        'exclusive',
        'educational_level_exclusive',
        'community',
        'institutional',
        'family',
        'intercultural',
        'coordinator',
        'educational_group',
        'educational_level',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    const EDUCATIONAL_GROUP_SELECT = [
        'MAS + Modalidad'                                 => 'MAS + Modalidad',
        'Procesos en formación de servicio Profesional'   => 'Procesos en formación de servicio Profesional',
        'Posgrado en primera infancia o temas afines'     => 'Posgrado en primera infancia o temas afines',
        'Procesos en formación de servicio Coordinadores' => 'Procesos en formación de servicio Coordinadores',
    ];

    const EDUCATIONAL_LEVEL_SELECT = [
        '1'  => 'Primaria incompleta',
        '2'  => 'Primaria completa',
        '3'  => '9 grado aprobado (4to Bachillerato)',
        '4'  => 'Bachillerato completo',
        '5'  => 'Técnico laboral con bachillerato incompleto relacionado con Primera infancia',
        '6'  => 'Técnico laboral con bachillerato completo relacionado con Primera infancia',
        '7'  => 'Técnico Laboral en otras áreas diferentes a la primera infancia',
        '8'  => 'Técnico profesional',
        '9'  => 'Licenciatura o pregrado',
        '10' => 'Posgrado',
    ];

    const EDUCATIONAL_LEVEL_EXCLUSIVE_SELECT = [
        '1'  => 'Primaria incompleta',
        '2'  => 'Primaria completa',
        '3'  => '9 grado aprobado (4to Bachillerato)',
        '4'  => 'Bachillerato completo',
        '5'  => 'Técnico laboral con bachillerato incompleto relacionado con Primera infancia',
        '6'  => 'Técnico laboral con bachillerato completo relacionado con Primera infancia',
        '7'  => 'Técnico Laboral en otras áreas diferentes a la primera infancia',
        '8'  => 'Técnico profesional',
        '9'  => 'Licenciatura o pregrado',
        '10' => 'Posgrado',
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

    public function courseshooksCourses()
    {
        return $this->belongsToMany(Course::class);
    }

    public function courseshooksSelfInterestedUsers()
    {
        return $this->belongsToMany(SelfInterestedUser::class);
    }

    public function entities()
    {
        return $this->belongsToMany(Entity::class);
    }

    public function departments()
    {
        return $this->belongsToMany(Department::class);
    }

    public function getFileAttribute()
    {
        return $this->getMedia('file')->last();
    }
}
