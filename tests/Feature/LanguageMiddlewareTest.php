<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LanguageMiddlewareTest extends TestCase
{

    public function test_set_language(): void
    {
        $testLocale = 'testLocale';
        $response = $this->withSession(['language' => $testLocale])->get('/login');

        $response->assertStatus(200)->assertSeeHtml('<html lang="'.$testLocale.'">');

        
    }
}
