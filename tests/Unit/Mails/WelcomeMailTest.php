<?php

namespace Tests\Unit\Entities;

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class WelcomeMailTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function send_email()
    {
        Mail::fake();

        $mail = new WelcomeMail();

        $this->assertInstanceOf(WelcomeMail::class, $mail->build());
    }
}
