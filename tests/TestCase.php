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

    // protected function setUp() : void
    // {
    //     parent::setUp();
    //     $this->position = Position::factory()->create();
    //     $this->user = User::factory()->create();
    // }

    protected function setFactoryData(int $position_id) : void
    {
        if (!Position::find($position_id)){
            $this->position = Position::factory()->create([
                'id' => $position_id
            ]);   
        }

        $this->user = User::factory()->create([
            'position_id' => $this->position->id
        ]);
    }

}
