<?php

namespace App\Http\Controllers;

use App\Http\Requests\Client\StoreClientRequest;
use App\Http\Requests\Client\UpdateClientRequest;
use App\Models\Client;
use App\Repository\ClientRepository;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ClientController extends Controller
{
    /**
     * Initialize the client repository class
     * 
     * @param ClientRepository
     * @return void
     */
    public function __construct(protected ClientRepository $repository) {}

    /**
     * @return View
     */
    public function index(Request $request): View
    {
        $search = $request->search;
        $clients = $this->repository->all($search);

        return view('client.index', [
            'clients' => $clients,
            'search' => $search
        ]);
    }

    /**
     * Handle create client view
     * 
     * @return View
     */
    public function create(): View
    {
        return view('client.create');
    }

    /**
     * Handle store client
     * 
     * @param StoreClientRequest
     * @return RedirectResponse
     */
    public function store(StoreClientRequest $request): RedirectResponse
    {
        $this->repository->create($request->validated());

        return Redirect::route('client.create')->with('status', 'client-created');
    }

    /**
     * Handle edit client view
     * 
     * @param Client
     * @return View
     */
    public function edit(Client $client): View
    {
        return view('client.edit', [
            'client' => $client
        ]);
    }

    /**
     * Handle update client
     * 
     * @param UpdateClientRequest
     * @param Client
     * 
     * @return RedirectResponse
     */
    public function update(UpdateClientRequest $request, Client $client): RedirectResponse
    {
        $this->repository->update($client->id, $request->validated());

        return Redirect::route('client.edit', $client->id)->with('status', 'client-updated');
    }

    /**
     * Handle delete client
     * 
     * @param Client $client
     * @return RedirectResponse
     */
    public function destroy(Client $client)
    {
        $this->repository->delete($client->id);

        return Redirect::route('client.index');
    }
}
