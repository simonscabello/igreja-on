<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static find(int $id)
 * @method static create(array $data)
 * @property int $id
 * @property string $email
 * @property string $phone
 */
class Member extends Model
{
    use hasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
    ];
}
