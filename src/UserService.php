<?php

declare(strict_types=1);

namespace Services;

use Exception;

class UserService extends ApiService
{

    public function __construct()
    {
        $this->endpoint = config('services.internal.users.address') . '/api';
    }

    /**
     * Register user method
     *
     * @param array $data
     * @return array|mixed
     * @throws Exception
     */
    public function register(array $data): mixed
    {
        return $this->post('register', $data);
    }

    /**
     * Register user method
     *
     * @param array $data
     * @return array|mixed
     * @throws Exception
     */
    public function login(array $data): mixed
    {
        return $this->post('login', $data);
    }

    /**
     * Get authenticated user method
     *
     * @return array|mixed
     * @throws Exception
     */
    public function profile(): mixed
    {
        return $this->get('user');
    }

    /**
     * Logout method
     *
     * @return array|mixed
     * @throws Exception
     */
    public function logout(): mixed
    {
        return $this->post('logout', []);
    }

    /**
     * Update info method
     *
     * @return array|mixed
     * @throws Exception
     */
    public function updateInfo(array $info): mixed
    {
        return $this->put('users/info', $info);
    }

    /**
     * Update password method
     *
     * @return array|mixed
     * @throws Exception
     */
    public function updatePassword(string $password): mixed
    {
        return $this->put('users/password', ['password' => $password]);
    }

    /**
     * Get all users
     *
     * @return array|mixed
     * @throws Exception
     */
    public function users(): mixed
    {
        return $this->get('users');
    }

    /**
     * Get user by id
     *
     * @param int $id
     * @return array|mixed
     * @throws Exception
     */
    public function user(int $id): mixed
    {
        return $this->get("users/$id");
    }
}
