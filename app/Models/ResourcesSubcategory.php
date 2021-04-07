<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class ResourcesSubcategory extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'resources_subcategories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'resourcescategory_id',
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function resourcessubcategorySubcategoriesSets()
    {
        return $this->hasMany(SubcategoriesSet::class, 'resourcessubcategory_id', 'id');
    }

    public function resourcessubcategoryResources()
    {
        return $this->hasMany(Resource::class, 'resourcessubcategory_id', 'id');
    }

    public function resourcescategory()
    {
        return $this->belongsTo(ResourcesCategory::class, 'resourcescategory_id');
    }
}
