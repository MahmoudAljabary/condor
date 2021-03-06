<?php

use App\User;

trait CreateUser
{
    private function createUsers($count, $overrides = [])
    {
        return factory(User::class, $count)->create($overrides);
    }

    private function createUser($overrides = [])
    {
        return factory(User::class)->create($overrides);
    }

    private function makeUser()
    {
        return factory(User::class)->make();
    }
}
