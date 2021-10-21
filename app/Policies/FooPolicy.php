<?php

namespace App\Policies;

use App\Models\Foo;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class FooPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param User|null $user
     * @return bool
     */
    public function viewAny(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param User|null $user
     * @param Foo $foo
     * @return bool
     */
    public function view(?User $user, Foo $foo)
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     *
     * @param User|null $user
     * @return bool
     */
    public function create(?User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param User|null $user
     * @param Foo $foo
     * @return bool
     */
    public function update(?User $user, Foo $foo)
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param User|null $user
     * @param Foo $foo
     * @return bool
     */
    public function delete(?User $user, Foo $foo)
    {
        return true;
    }
}
