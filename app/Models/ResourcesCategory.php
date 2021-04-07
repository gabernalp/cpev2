<?php

namespace App\Models;

use App\Traits\Auditable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class ResourcesCategory extends Model
{
    use SoftDeletes, Auditable, HasFactory;

    public $table = 'resources_categories';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function resourcescategoryResourcesSubcategories()
    {
        return $this->hasMany(ResourcesSubcategory::class, 'resourcescategory_id', 'id');
    }

    public function resourcescategoryResources()
    {
        return $this->hasMany(Resource::class, 'resourcescategory_id', 'id');
    }
}
