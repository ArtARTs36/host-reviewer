<?php

namespace App\Repository;

use App\User;

/**
 * Class UserRepository
 * @package App\Repository
 */
class UserRepository extends Repository
{
    /**
     * @return string
     */
    protected function getModelClass(): string
    {
        return User::class;
    }

    /**
     * @param string $login
     * @param string $password
     * @return User|null
     */
    public function credentials(string $login, string $password): ?User
    {
        return $this->newQuery()
            ->where(User::FIELD_LOGIN, $login)
            ->where(User::FIELD_PASSWORD, $this->encrypt($password))
            ->first();
    }

    /**
     * @param string $login
     * @param string $password
     * @return User
     */
    public function create(string $login, string $password): User
    {
        return $this->newQuery()
            ->create([
                User::FIELD_LOGIN => $login,
                User::FIELD_PASSWORD => $this->encrypt($password),
            ]);
    }

    public function credentialsOr(\Closure $or, string $login, string $password)
    {
        return $this->credentials($login, $password) ?? $or($login, $password);
    }

    private function encrypt(string $password)
    {
        return sha1($password);
    }
}
