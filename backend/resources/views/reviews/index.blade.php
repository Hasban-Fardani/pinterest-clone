<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reviews') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-black">
                {{-- Todo user table --}}
                <div class="overflow-x-auto">
                    <form action="{{ route('reviews.index') }}" method="get" class="flex w-1/2 gap-2">
                        <input type="text" name="q" class="grow input input-bordered focus:outline-none" placeholder="Search" value="{{ request('q') }}" />
                        <button type="submit" class="btn btn-primary">
                            Search
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>

                        </button>
                    </form>
                    @if (request('q'))
                    <p>search: {{ request('q') }} - {{ $reviews->total() }} results</p>
                    @endif
                    <table class="table">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th scope="row" class="font-bold text-lg">Post Gambar</th>
                                <th scope="row" class="font-bold text-lg">Komentar</th>
                                <th scope="row" class="font-bold text-lg">Status</th>
                                <th scope="row" class="font-bold text-lg">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reviews as $review)
                            <tr>
                                <td><img src="{{ '/storage/posts/'.$review->post->image }}" alt="{{ $review->post->title }}" class="w-16 h-16"></td>
                                <td>
                                    <div class="flex flex-col justify-center">
                                        <p class="max-w-full font-semibold">"{{ $review->comment }}"</p>
                                        <p class="text-sm">by: <a href="{{ route('users.index', ['q' => $review->user->name])}}" class="link">{{ $review->user->name }}</a></p>
                                    </div>
                                </td>
                                <td>
                                    @if ($review->status == 'pending')
                                    <div class="badge badge-warning text-white">Pending</div>
                                    @elseif ($review->status == 'approved')
                                    <div class="badge badge-success text-white">Approved</div>
                                    @elseif ($review->status == 'rejected')
                                    <div class="badge badge-error text-white">Rejected</div>
                                    @endif
                                </td>
                                <td>
                                    @if ($review->status == 'pending')
                                    <div class="flex gap-2">
                                        <form action="{{ route('reviews.update', $review) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="approved">
                                            <button type="submit" class="btn btn-primary btn-sm flex gap-2 w-32" value="approve">
                                                Approve
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                                                </svg>
                                            </button>
                                        </form>

                                        <form action="{{ route('reviews.update', $review) }}" method="post">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="status" value="rejected">
                                            <button type="submit" class="btn btn-error btn-sm flex gap-2 w-24">
                                                Reject
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                    @else
                                    <form action="{{ route('reviews.update', $review) }}" method="post">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="{{ $review->status == 'approved' ? 'rejected' : 'approved' }}">
                                        <button type="submit" class="btn {{ $review->status == 'approved' ? 'btn-error' : 'btn-primary' }} btn-sm flex gap-2 w-24">
                                            {{ $review->status == 'approved' ? 'Reject' : 'Approve' }}
                                        </button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{ $reviews->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
