<?php

namespace App\Contracts;

use App\Models\Client;
use Illuminate\Pagination\LengthAwarePaginator;

interface ClientRepositoryInterface
{
    /**
     * Handle the record with paginate aware
     * 
     * @return LengthAwarePaginator
     */
    public function all(): LengthAwarePaginator;

    /**
     * Filter client by id
     * 
     * @param int $id
     * @return ?Client
     */
    public function findById(int $id): ?Client;

    /**
     * Create client
     * 
     * @param array $data
     * @return Client
     */
    public function create(array $data): Client;
    /**
     * Update client
     * 
     * @param int $id
     * @param array $data
     * @return Client
     */
    public function update(int $id, array $data): Client;

    /**
     * Delete client
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
