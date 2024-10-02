<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Akun ' . $user->name) }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-black">
                <form action="{{ route('users.update', $user) }}" method="post" class="grid grid-cols-1 lg:grid-cols-2 gap-6 ">
                    @csrf
                    @method('PUT')
                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Nama</span>
                        </div>
                        <input type="text" name="name" placeholder="Nama" class="input input-bordered w-full" value="{{ $user->name }}" />
                    </label>

                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Username</span>
                        </div>
                        <input type="text" name="username" placeholder="Username" class="input input-bordered w-full" value="{{ $user->username }}" />
                    </label>

                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Username</span>
                        </div>
                        <input type="email" name="email" placeholder="Email" class="input input-bordered w-full" value="{{ $user->email }}" />
                    </label>

                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Role</span>
                        </div>
                        <select class="select select-bordered w-full" name="role">
                            <option disabled selected>Role</option>
                            <option value="user" @selected($user->role == 'user')>User</option>
                            <option value="admin" @selected($user->role == 'admin')>Admin</option>
                        </select>
                    </label>

                    <div class="col-span-full flex items-end justify-end gap-3">
                        <a href="{{ route('users.index') }}" class="btn btn-neutral mr-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-app-layout>
