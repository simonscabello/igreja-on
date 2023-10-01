<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static create(array $data)
 * @method static find(int $id)
 *
 * @property int $id
 */
class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id',
        'phone',
        'email',
    ];

    public function member(): BelongsTo
    {
        return $this->belongsTo(Address::class);
    }
}
