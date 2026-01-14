<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-extrabold text-indigo-700">
            📊 Laporan: {{ $activity->name }}
        </h2>
        <p class="text-sm text-gray-500">
            Pantau perjalananmu dengan santai 🌱
        </p>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto px-4 space-y-10">

        <!-- FILTER -->
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('reports.show', $activity) }}?range=monthly"
               class="px-5 py-2 rounded-full border font-semibold
               {{ $range === 'monthly'
                    ? 'bg-indigo-500 text-white shadow-md'
                    : 'bg-white text-indigo-500' }}">
                📅 Bulanan
            </a>

            <a href="{{ route('reports.show', $activity) }}?range=weekly"
               class="px-5 py-2 rounded-full border font-semibold
               {{ $range === 'weekly'
                    ? 'bg-indigo-500 text-white shadow-md'
                    : 'bg-white text-indigo-500' }}">
                🗓 Mingguan
            </a>

            @if ($range === 'weekly')
                <a href="{{ route('reports.show', $activity) }}?range=weekly&week={{ $weekOffset - 1 }}"
                   class="px-4 py-2 rounded-full bg-gray-100 hover:bg-gray-200 text-sm">
                    ⬅ Minggu lalu
                </a>

                @if ($weekOffset < 0)
                    <a href="{{ route('reports.show', $activity) }}?range=weekly&week={{ $weekOffset + 1 }}"
                       class="px-4 py-2 rounded-full bg-gray-100 hover:bg-gray-200 text-sm">
                        Minggu depan ➡
                    </a>
                @endif
            @endif
        </div>

        <!-- RINGKASAN -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
            <div class="rounded-2xl bg-indigo-100 p-4 text-center shadow">
                <div class="text-sm text-indigo-700">⏱ Hari berjalan</div>
                <div class="text-3xl font-extrabold text-indigo-800">
                    {{ $totalDaysRunning }}
                </div>
            </div>

            <div class="rounded-2xl bg-green-100 p-4 text-center shadow">
                <div class="text-sm text-green-700">🟢 Berhasil</div>
                <div class="text-3xl font-extrabold text-green-700">
                    {{ $summary['success'] }}
                </div>
            </div>

            <div class="rounded-2xl bg-red-100 p-4 text-center shadow">
                <div class="text-sm text-red-700">🔴 Gagal</div>
                <div class="text-3xl font-extrabold text-red-700">
                    {{ $summary['fail'] }}
                </div>
            </div>

            <div class="rounded-2xl bg-gray-100 p-4 text-center shadow">
                <div class="text-sm text-gray-600">⏳ Belum</div>
                <div class="text-3xl font-extrabold text-gray-600">
                    {{ $summary['pending'] }}
                </div>
            </div>
        </div>

        <!-- KALENDER -->
        @foreach ($activity->tasks as $task)
            <div class="rounded-2xl bg-white p-5 shadow-md">
                <h3 class="font-bold text-lg mb-4">
                    ⭐ {{ $task->name }}
                </h3>

                <div class="flex gap-3 overflow-x-auto pb-2">
                    @foreach ($dates as $date)
                        @php
                            if ($task->type === 'weekly') {
                                if (!in_array(strtolower($date->format('D')), $task->days ?? [])) {
                                    continue;
                                }
                            }

                            $log = $task->logs->first(
                                fn ($l) => $l->log_date->toDateString() === $date->toDateString()
                            );

                            if ($date->greaterThan($today)) {
                                $bg = 'bg-gray-200';
                            } elseif ($log?->status === 'success') {
                                $bg = 'bg-green-400';
                            } elseif ($log?->status === 'fail') {
                                $bg = 'bg-red-400';
                            } else {
                                $bg = 'bg-white';
                            }
                        @endphp

                        <div class="text-center">
                            <div class="text-xs mb-1 text-gray-500">
                                {{ $date->format('d/m') }}
                            </div>
                            <div class="w-8 h-8 rounded-xl border shadow-sm {{ $bg }}"></div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach

    </div>
</x-app-layout>
