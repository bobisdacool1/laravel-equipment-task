<?php

namespace App\Models;

use Database\Factories\EquipmentFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'type_id',
        'serial_code',
        'note',
    ];

    /**
     * @return EquipmentFactory
     */
    protected static function newFactory()
    {
        return EquipmentFactory::new();
    }

    /**
     * @return BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(EquipmentType::class);
    }
}
