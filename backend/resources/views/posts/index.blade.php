<x-app-layout>
    <x-slot name="header">
        <div class="flex gap-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Posts') }}
            </h2>
            <x-create-post />
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 text-black">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="mb-4">
                    <form action="{{ route('posts.index') }}" method="get" class="flex w-1/2 gap-2">
                        <input type="text" name="q" class="grow input input-bordered focus:outline-none" placeholder="Search" value="{{ request('q') }}" onfocus="this.value = this.value;" autofocus />
                        <button type="submit" class="btn btn-primary">
                            Search
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>

                        </button>
                    </form>
                    @if (request('q'))
                    <p>search: {{ request('q') }} - {{ $posts->total() }} results</p>
                    @endif
                </div>
                <div class="overflow-x-auto box-border columns-2 md:columns-4 min-w-full">
                    @foreach ($posts as $post)
                    <div class="w-full mb-4 break-inside-avoid relative group">
                        <div class="relative max-h-fit">
                            <div class="-z-10 group-hover:z-10 absolute backdrop-blur-md bg-white/20 rounded-lg w-full h-full">
                                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 flex gap-2">
                                    <button class="btn btn-warning" aria-haspopup="dialog" aria-expanded="false" aria-controls="modal-edit-post" data-overlay="#modal-edit-post" onclick="editPost({{ $post->id }}, '{{ $post->title }}', '{{ $post->image }}')">Edit</button>
                                    <button class="btn btn-error" onclick="confirmDelete({{ $post->id }}, '{{ $post->title }}')">Hapus</button>
                                    <form action="{{ route('posts.destroy', $post) }}" method="post" id="delete-form-{{ $post->id }}">@csrf @method('delete')</form>
                                </div>
                            </div>
                            <img src="{{ $post->image }}" alt="{{ $post->title }}" class="min-w-full rounded-lg">
                        </div>
                        <h3 class="mt-2 text-lg font-bold leading-none mb-2">{{ $post->title }}</h3>
                        <div class="flex items-center gap-3">
                            <div class="avatar">
                                <div class="size-10 rounded-full">
                                    <img src="{{ $post->user->avatar ?? 'https://ui-avatars.com/api/?name=user' }}" alt="{{ $post->user->name }}">
                                </div>
                            </div>
                            <p>{{ $post->user->name }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
                {{ $posts->links() }}
            </div>
        </div>
    </div>

    <x-edit-post />
    <x-slot name="js">
        <script>
            function editPost(id, title, image) {
                document.getElementById('edit-post-title').value = title;
                document.getElementById('image-edit-post-preview').src = image;
                document.getElementById('image-edit-post-preview').style.display = 'block';
                document.getElementById('edit-post-form').action = "{{ route('posts.update', ':id') }}".replace(':id', id);
                document.getElementById('edit-post-title').focus();
            };

            async function confirmDelete(id, name) {
                Swal.fire({
                    title: "Apakah Kamu Yakin?"
                    , text: "Kamu Akan Menghapus Postingan Ini: " + name
                    , icon: "warning"
                    , showCancelButton: true
                    , confirmButtonColor: "#3085d6"
                    , cancelButtonColor: "#d33"
                    , confirmButtonText: "Ya, Hapus!"
                    , cancelButtonText: "Tidak"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                        Swal.fire({
                            title: "Berhasil!"
                            , text: "Postingan Berhasil Dihapus."
                            , icon: "success"
                        });

                    }
                });
            }

        </script>
    </x-slot>
</x-app-layout>
