<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('User List') }}
            </h2>
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm ms-3">
                Buat
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>

            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-black">
                {{-- Todo user table --}}
                <div class="overflow-x-auto">
                    <form action="{{ route('users.index') }}" method="get" class="flex w-1/2 gap-2">
                        <input type="text" name="q" class="grow input input-bordered focus:outline-none"
                            placeholder="Search" value="{{ request('q') }}" />
                        <button type="submit" class="btn btn-primary">
                            Search
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>

                        </button>
                    </form>
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th scope="row" class="font-bold text-lg"></th>
                                <th scope="row" class="font-bold text-lg">Username</th>
                                <th scope="row" class="font-bold text-lg">Email</th>
                                <th scope="row" class="font-bold text-lg">Role</th>
                                <th scope="row" class="font-bold text-lg">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>
                                        <div class="flex flex-col justify-center">
                                            <p class="font-thin text-sm">
                                                {{ $user->name }}
                                            </p>
                                            <p class="font-semibold text-lg">
                                                {{ $user->username }}
                                            </p>
                                        </div>
                                    </td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if ($user->role == 'admin')
                                            <div class="badge badge-warning text-white">
                                                Admin
                                            </div>
                                        @else
                                            <div class="badge badge-success text-white">
                                                User
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('users.edit', $user->id) }}"
                                            class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="post"
                                            class="inline-block" id="delete-form-{{ $user->id }}">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        <button type="button" class="btn btn-error btn-sm"
                                            onclick="confirmDelete({{ $user->id }}, '{{ $user->name }}')">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    <x-slot name="js">
        <script>
            async function confirmDelete(id, name) {
                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });

                    }
                });
            }
        </script>
    </x-slot>
</x-app-layout>
