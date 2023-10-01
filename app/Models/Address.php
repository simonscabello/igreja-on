<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static find(int $id)
 * @method static create(array $data)
 *
 * @property mixed $id
 */
class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'complement',
        'district',
        'member_id',
        'number',
        'state',
        'street',
        'zip_code',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
