<?php

namespace Services;

use Exception;
use Illuminate\Support\Facades\Http;

abstract class ApiService
{
    public string $endpoint;

    /**
     * Request helper method
     *
     * @throws Exception
     */
    private function request(string $method, string $path, array $data = [])
    {
        $response = $this->setRequest($method, $path, $data);

        if ($response->ok()) {
            return $response->json();
        }

        throw new \HttpException($response->status(), $response->body());
    }

    public function setRequest(string $method, string $path, array $data = [])
    {
        return Http::acceptJson()->withHeaders([
            'Authorization' => 'Bearer ' . request()->cookie('jwt')
        ])
            ->$method("{$this->endpoint}/$path", $data);
    }

    /**
     * Post method for api call
     *
     * @param string $path
     * @param array $data
     * @return array|mixed
     * @throws Exception
     */
    protected function post(string $path, array $data): mixed
    {
        return $this->request('post', $path, $data);
    }

    /**
     * Get method for api call
     *
     * @param string $path
     * @return array|mixed
     * @throws Exception
     */
    protected function get(string $path): mixed
    {
        return $this->request('get', $path);
    }

    /**
     * Put method for api call
     *
     * @param string $path
     * @param array $data
     * @return array|mixed
     * @throws Exception
     */
    protected function put(string $path, array $data): mixed
    {
        return $this->request('put', $path, $data);
    }

    /**
     * Delete method for api call
     *
     * @param string $path
     * @return array|mixed
     * @throws Exception
     */
    protected function delete(string $path): mixed
    {
        return $this->request('delete', $path);
    }
}
