<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public function extractIdFromUrl($url): ?string
    {
        if (preg_match('/\/(\d+)\/edit$/', $url, $matches)) {
            return $matches[1];
        }

        return null;
    }
}
