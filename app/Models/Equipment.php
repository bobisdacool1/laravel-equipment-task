<?php

namespace App\Models;

use Database\Factories\EquipmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type_id',
        'serial_code',
        'note',
    ];

    protected static function newFactory()
    {
        return EquipmentFactory::new();
    }

    public function type()
    {
        return $this->belongsTo(EquipmentType::class);
    }
}
