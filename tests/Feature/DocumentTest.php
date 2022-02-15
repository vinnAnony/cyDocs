<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentTest extends TestCase
{
    use DatabaseMigrations;
    /** @test */
    public function a_user_can_view_all_documents()
    {
        $this->get('/documents')
            ->assertSee($this->document->title);
    }
}
