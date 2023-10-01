<?php

namespace App\Enum;

enum MaritalStatusEnum: string
{
    case SINGLE = 'single';
    case MARRIED = 'married';
    case DIVORCED = 'divorced';
    case WIDOWED = 'widowed';

    public function getLabel(): string
    {
        return match ($this) {
            self::SINGLE => trans('member.marital_status.single'),
            self::MARRIED => trans('member.marital_status.married'),
            self::DIVORCED => trans('member.marital_status.divorced'),
            self::WIDOWED => trans('member.marital_status.widowed'),
        };
    }
}
