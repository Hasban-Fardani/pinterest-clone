<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Buat Akun Baru') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-black">
                <form action="{{ route('users.store') }}" method="post" class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    @csrf
                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Nama</span>
                        </div>
                        <input type="text" name="name" placeholder="Nama"
                            class="input input-bordered w-full max-w-xs" />
                    </label>

                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Username</span>
                        </div>
                        <input type="text" name="username" placeholder="Username"
                            class="input input-bordered w-full max-w-xs" />
                    </label>

                    <label class="form-control w-full">
                        <div class="label">
                            <span class="label-text">Pick the best fantasy franchise</span>
                        </div>
                        <select class="select select-bordered w-full" name="role">
                            <option disabled selected>Role</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </label>

                    <label class="form-control w-full max-w-xs">
                        <div class="label">
                            <span class="label-text">Password</span>
                        </div>
                        <input type="password" name="password" placeholder="password"
                            class="input input-bordered w-full max-w-xs" />
                    </label>

                    <div class="">
                        <a href="{{ route('users.index')}}" class="btn btn-neutral mr-2">Kembali</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</x-app-layout>

