<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-gray-800 leading-tight flex justify-between">
            {{ __('Users') }}
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 border border-blue-700 rounded"
            data-target="#addUser" data-toggle="modal">
                Add User
        </button>
            <!-- Button trigger modal -->
        </h2>
    </x-slot>
    @if(session('message'))
        <div class="bg-green-500 shadow-lg p-2 rounded text-white mb-2">
            {{ session('message') }}
        </div>
    @endif


    <div>
        <div class="not-prose relative bg-slate-50 rounded-xl overflow-hidden shadow-lg">
                <div class="relative rounded-xl overflow-auto">
                    <div class="shadow-sm overflow-hidden">
                    <table class="border-collapse table-auto w-full text-sm">
                        <thead class="border-b-2 border-gray-600">
                        <tr>
                            <th class="font-medium p-4 pl-8 pt-0 text-black text-left">Name</th>
                            <th class="font-medium p-4 pt-0 pb-3 text-black text-left">Email</th>
                            <th class="font-medium p-4 pr-8 pt-0 text-black text-left">Created At</th>
                            <th class="font-medium p-4 pr-8 pt-0 text-black text-left">Status</th>
                            <th class="font-medium p-4 pr-8 pt-0 text-black text-left"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td class=" p-4 pl-8 text-black">{{ $user->name }}</td>
                            <td class=" p-4 text-black">{{ $user->email }}</td>
                            <td class=" p-4 pr-8 text-black">{{ $user->created_at }}</td>
                            <td class=" p-4 pr-8 text-black">
                                @if ($user->approved_at)
                                    <span class="bg-green-500 text-white text-xs font-bold py-1 px-3 rounded">Approved</span> 
                                @else
                                <span class="bg-red-500 text-white font-bold text-xs py-1 px-3 rounded">Not Approved</span> 
                                @endif
                            </td>
                            <td class=" p-4 pr-8 text-white">
                            <form method="post" action="{{ route('admin.users.approve', $user->id) }}">
                                @csrf
                                @method('patch')
                                <button type="submit" class="btn btn-{{ $user->approved_at ? 'danger' : 'success' }} bg-blue-400 rounded py-1 px-1 font-bold">
                                    {{ $user->approved_at ? 'Disapprove' : 'Approve' }}
                                </button>
                            </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
        </div>
    </div>
                                                        <!-- Modal -->
            <div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="post">
                    @csrf
                        <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                            Name
                        </label>
                        <input type="text" name="name" id="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="name">
                        </div>
                        <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                            Email
                        </label>
                        <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" placeholder="email">
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary bg-blue-500">Save</button>
                </div>
                </form>
                </div>
            </div>
            </div>
            
</x-app-layout>