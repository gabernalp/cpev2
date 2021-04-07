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

class Resource extends Model implements HasMedia
{
    use SoftDeletes, InteractsWithMedia, Auditable, HasFactory;

    public $table = 'resources';

    protected $appends = [
        'file',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'resourcescategory_id',
        'resourcessubcategory_id',
        'subcategoriesset_id',
        'name',
        'comments',
        'created_at',
        'updated_at',
        'deleted_at',
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

    public function resourcescategory()
    {
        return $this->belongsTo(ResourcesCategory::class, 'resourcescategory_id');
    }

    public function resourcessubcategory()
    {
        return $this->belongsTo(ResourcesSubcategory::class, 'resourcessubcategory_id');
    }

    public function subcategoriesset()
    {
        return $this->belongsTo(SubcategoriesSet::class, 'subcategoriesset_id');
    }

    public function getFileAttribute()
    {
        return $this->getMedia('file')->last();
    }
}
