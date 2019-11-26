<?php
namespace App\Service\Database;

use App\Constraints\TestUserRepositoryInterface;
use App\Models\User;

class TestDbUser implements TestUserRepositoryInterface
{
    public function all() : array
    {
        $data = User::all()->toArray();
        return $data;
    }
}
