<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentTest extends TestCase
{
    /** @test */
    public function a_user_can_view_all_documents()
    {
        $this->get('/threads')
            ->assertSee($this->document->title);
    }
}
