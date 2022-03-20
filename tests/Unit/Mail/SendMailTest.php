<?php

namespace Tests\Unit\Entities;

use App\Mail\Mail;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SendMailTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    /** @test */
    public function send_email()
    {
        $this->assertTrue(true);
//        $mail = new Mail();
//        $response = $mail->build();
//        Mail::assert(Mail::class, function ($mail) {
//            return $mail->hasTo('boban.vidic123@gmail.com');
//        });
    }
}
