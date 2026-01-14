<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Laporan
        </h2>
    </x-slot>

    <div class="py-6 max-w-5xl mx-auto px-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            @foreach ($activities as $activity)
                <a href="{{ route('reports.show', $activity) }}">
                    <div class="border rounded p-4 hover:bg-gray-50">
                        <h3 class="font-semibold">{{ $activity->name }}</h3>
                        <p class="text-sm text-gray-500">
                            Mulai: {{ $activity->start_date }}
                        </p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</x-app-layout>
