<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class SubcategoriesSet extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'subcategories_sets';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'resourcescategory_id',
        'resourcessubcategory_id',
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function subcategoriessetResources()
    {
        return $this->hasMany(Resource::class, 'subcategoriesset_id', 'id');
    }

    public function resourcescategory()
    {
        return $this->belongsTo(ResourcesCategory::class, 'resourcescategory_id');
    }

    public function resourcessubcategory()
    {
        return $this->belongsTo(ResourcesSubcategory::class, 'resourcessubcategory_id');
    }
}
