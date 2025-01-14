<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LanguageTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_update(): void
    {
        $response = $this->post('/language-change', ['language' => 'pl']);

        $response->assertSessionHas('language');
    }
}
