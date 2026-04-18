<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end mb-4">
                        <a  href="{{ route('client.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'">Create</a>
                    </div>
                    <x-modal name="confirm-client-deletion" focusable>
                        <form method="POST" action="" id="delete-client-form" class="p-6">
                            @csrf
                            @method('DELETE')

                            <h2 class="text-lg font-medium text-gray-900">
                                Are you sure you want to delete this client?
                            </h2>

                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    Cancel
                                </x-secondary-button>

                                <x-danger-button class="ms-3">
                                    Delete
                                </x-danger-button>
                            </div>
                        </form>
                    </x-modal>
                    <form method="GET" action="{{ route('client.index') }}">
                        <input 
                            type="text"
                            class="mb-2 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Search clients..."
                        >
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'">Search</button>
                    </form>
                    <table class="table-auto w-full border border-gray-400">
                        <thead>
                            <tr>
                                <th class="border border-gray-400 px-4 py-2">Name</th>
                                <th class="border border-gray-400 px-4 py-2">E-mail</th>
                                <th class="border border-gray-400 px-4 py-2">Status</th>
                                <th class="border border-gray-400 px-4 py-2">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($clients as $client )
                                <tr>
                                    <td class="border border-gray-400 px-4 py-2">{{ $client->name }}</td>
                                    <td class="border border-gray-400 px-4 py-2">{{ $client->email }}</td>
                                    <td class="border border-gray-400 px-4 py-2">{{ ucfirst($client->status) }}</td>
                                    <td class="border border-gray-400 px-4 py-2">
                                        <a  href="{{ route('client.edit', $client->id) }}"class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150'">Edit</a>
                                        
                                        <x-danger-button
                                            x-data=""
                                            x-on:click.prevent="
                                                document.getElementById('delete-client-form').action = '{{ route('client.destroy', $client->id) }}';
                                                $dispatch('open-modal', 'confirm-client-deletion');
                                            "
                                        >
                                            Delete
                                        </x-danger-button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="border border-gray-400 px-4 py-2 text-center">
                                        <span class="flex justify-center text-center"> No data found.</span>
                                    </td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                        
                    </table>
                    <div class="mt-5">
                        {{ $clients->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
