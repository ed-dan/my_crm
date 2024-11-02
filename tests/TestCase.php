<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Models\User;
use App\Models\Position;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected User $user;
    protected Position $position;

    protected function setUp() : void
    {
        parent::setUp();

        $this->position = Position::factory()->create();
        $this->user = $this->createUser();
    }

    private function createUser() : User
    {
        return User::factory()->create();
    }


}
