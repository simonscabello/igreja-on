<?php

namespace App\Models;

use App\Enum\GenderEnum;
use App\Enum\MaritalStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @method static find(int $id)
 * @method static create(array $data)
 *
 * @property int $id
 * @property string $name
 * @property string $gender
 * @property string $marital_status
 * @property string $identification_number
 */
class Member extends Model
{
    use hasFactory;

    protected $fillable = [
        'name',
        'birth_date',
        'gender',
        'marital_status',
        'identification_number',
    ];

    protected $casts = [
        'birth_date' => 'datetime',
        'marital_status' => MaritalStatusEnum::class,
        'gender' => GenderEnum::class,
    ];

    public function getFormattedFirstAddress(): string
    {
        /* @var Address $firstAddress */
        $firstAddress = $this->addresses->first();

        if (! $firstAddress) {
            return '';
        }

        return $firstAddress->street.', '.
            $firstAddress->number.', '.
            $firstAddress->district.', '.
            $firstAddress->city.', '.
            $firstAddress->state.', '.
            $firstAddress->zip_code;
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }

    public function address(): ?Address
    {
        return $this->addresses->first();
    }

    public function contacts(): HasMany
    {
        return $this->hasMany(Contact::class);
    }

    public function contact(): ?Contact
    {
        return $this->contacts->first();
    }
}
