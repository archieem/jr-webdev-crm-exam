<?php
namespace App\Repository;

use App\Contracts\ClientRepositoryInterface;
use App\Models\Client;
use Illuminate\Pagination\LengthAwarePaginator;

class ClientRepository implements ClientRepositoryInterface
{
    /**
     * Handle the client with paginate aware
     * 
     * @param ?string $search
     * @return LengthAwarePaginator
     */
    public function all(?string $search = null): LengthAwarePaginator
    {
        $query = Client::query();
        
        if ($search) {
            $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('status', 'like', "%{$search}%");
        }

        return $query->paginate(10);
    }
    /**
     * Filter client by id
     * 
     * @param int $id
     * @return ?Client
     */
    public function findById(int $id): ?Client
    {
        return Client::query()->findOrFail($id);
    }

    /**
     * Create client
     * 
     * @param array $data
     * @return Client
     */
    public function create(array $data): Client
    {
        return Client::create($data);
    }

    /**
     * Update client
     * 
     * @param int $id
     * @param array $data
     * @return Client
     */
    public function update(int $id, array $data): Client
    {
        $client = Client::findOrFail($id);
        $client->update($data);

        return $client;
    }
    
    /**
     * Delete client
     * 
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return Client::query()->whereId($id)->delete();
    }
}