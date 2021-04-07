<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \DateTimeInterface;

class ResourcesAudit extends Model
{
    use SoftDeletes, HasFactory;

    public $table = 'resources_audits';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'recurso_id',
        'ip',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function recurso()
    {
        return $this->belongsTo(Resource::class, 'recurso_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
