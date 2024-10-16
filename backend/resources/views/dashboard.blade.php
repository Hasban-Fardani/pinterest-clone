<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">
            <div class="stats">
                <div class="stat">
                    <div class="stat-figure text-base-content size-8">
                        <span class="icon-[tabler--world] size-8"></span>
                    </div>
                    <div class="stat-title">Total Post</div>
                    <div class="stat-value">{{ $postsCount }}</div>
                </div>

                <div class="stat">
                    <div class="stat-figure text-base-content size-8">
                        <span class="icon-[tabler--users-group] size-8"></span>
                    </div>
                    <div class="stat-title">Total Users</div>
                    <div class="stat-value">{{ $usersCount }}</div>
                </div>

                <div class="stat">
                    <div class="stat-figure text-base-content size-8">
                        <span class="icon-[tabler--users-group] size-8"></span>
                    </div>
                    <div class="stat-title">Total Comments</div>
                    <div class="stat-value">{{ $commentsCount }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
