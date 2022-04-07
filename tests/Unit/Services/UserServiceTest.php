<?php

namespace Tests\Unit\Entities;

use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function example_test_service_error()
    {
        $userRepository = Mockery::mock(UserRepository::class, function ($mock) {
            $mock
                ->shouldReceive('fetchAll')
                ->andReturnNull()
                ->getMock();
        });

        $userService = new UserService($userRepository);
        $response = $userService->exampleTestService();
        $this->assertEquals('Error', $response);
    }

    /** @test */
    public function example_test_service_case_1()
    {
        User::factory(2)->create();
        $userRepository = Mockery::mock(UserRepository::class, function ($mock) {
            $mock
                ->shouldReceive('fetchAll')
                ->andReturn(User::all())
                ->getMock();
        });

        $userService = new UserService($userRepository);
        $response = $userService->exampleTestService();

        $this->assertEquals('case 1', $response);
    }

    /** @test */
    public function example_test_service_case_2()
    {
        User::factory(3)->create();
        $userRepository = Mockery::mock(UserRepository::class, function ($mock) {
            $mock
                ->shouldReceive('fetchAll')
                ->andReturn(User::all())
                ->getMock();
        });

        $userService = new UserService($userRepository);
        $response = $userService->exampleTestService();

        $this->assertEquals('case 2', $response);
    }
}
