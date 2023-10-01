<?php

namespace App\Enum;

enum GenderEnum: string
{
    case MALE = 'male';

    case FEMALE = 'female';

    public function getLabel(): string
    {
        return match ($this) {
            self::FEMALE => trans('member.gender.female'),
            self::MALE => trans('member.gender.male'),
        };
    }
}
