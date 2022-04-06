<?php

namespace Tests\Unit\Entities;

use App\Jobs\CreateUserJob;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function create_user()
    {
        CreateUserJob::dispatch(10);
        $this->assertCount(10, User::get());
    }
}
