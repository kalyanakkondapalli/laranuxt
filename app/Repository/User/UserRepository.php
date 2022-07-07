<?php

namespace App\Repository\User;

use App\Models\User;

class UserRepository implements UserContract
{
    private User $user;

    /**
     * @param  User  $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function update(int $id, array $data)
    {
        $user = $this->find($id);
        return tap($user)->update($data);
    }

    /**
     * @inheritDoc
     */
    public function find(int $id, array $relations = [])
    {
        return $this->user->with($relations)->find($id);
    }

    /**
     * @inheritDoc
     */
    public function first(array $relations = [])
    {
        return $this->user->with($relations)->first();
    }
}
