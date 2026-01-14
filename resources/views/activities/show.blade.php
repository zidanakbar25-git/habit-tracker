<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-extrabold text-indigo-700">
            🌟 {{ $activity->name }}
        </h2>
        <p class="text-sm text-gray-500">
            Tidak harus sempurna, yang penting konsisten ✨
        </p>
    </x-slot>

    @php
        $weekOffset = request('week', 0);
        $startOfWeek = \Carbon\Carbon::today()->startOfWeek()->addWeeks($weekOffset);
        $today = \Carbon\Carbon::today();
    @endphp

    <div class="py-6 max-w-6xl mx-auto px-4 space-y-8">

        <!-- NAVIGASI MINGGU -->
        <div class="flex justify-between items-center">
            <a href="{{ route('activities.show', $activity) }}?week={{ $weekOffset - 1 }}"
               class="px-4 py-2 rounded-full bg-gray-100 hover:bg-gray-200 text-sm">
                ⬅ Minggu lalu
            </a>

            <div class="font-bold text-indigo-600 text-sm">
                {{ $startOfWeek->format('d M') }} – {{ $startOfWeek->copy()->addDays(6)->format('d M Y') }}
            </div>

            <a href="{{ route('activities.show', $activity) }}?week={{ $weekOffset + 1 }}"
               class="px-4 py-2 rounded-full bg-gray-100 hover:bg-gray-200 text-sm">
                Minggu depan ➡
            </a>
        </div>

        <!-- FORM TAMBAH TASK -->
        <form method="POST" action="{{ route('tasks.store', $activity) }}"
              class="bg-white rounded-2xl shadow-md p-6 space-y-4">
            @csrf

            <h3 class="font-bold text-lg text-indigo-700">
                ➕ Tambah Task
            </h3>

            <input
                type="text"
                name="name"
                placeholder="Contoh: Push-up, Jogging"
                class="w-full rounded-full border-gray-300 px-4 py-3"
                required
            >

            <div class="flex gap-4 text-sm">
                <label><input type="radio" name="type" value="daily" checked> Setiap hari</label>
                <label><input type="radio" name="type" value="weekly"> Mingguan</label>
            </div>

            <div class="flex flex-wrap gap-3 text-sm">
                @php
                    $days = [
                        'mon'=>'Sen','tue'=>'Sel','wed'=>'Rab',
                        'thu'=>'Kam','fri'=>'Jum','sat'=>'Sab','sun'=>'Min'
                    ];
                @endphp
                @foreach ($days as $key => $label)
                    <label>
                        <input type="checkbox" name="days[]" value="{{ $key }}"> {{ $label }}
                    </label>
                @endforeach
            </div>

            <button
                class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-3 rounded-full font-bold shadow">
                Simpan 🌱
            </button>
        </form>

        <!-- CHECKLIST -->
        @if ($activity->tasks->isEmpty())
            <div class="bg-white rounded-2xl shadow p-6 text-center text-gray-500">
                Belum ada task ✨  
                Tambahkan task untuk mulai mencatat
            </div>
        @else
            @foreach ($activity->tasks as $task)
                <div class="bg-white rounded-2xl shadow-md p-6">
                    <h3 class="font-bold text-lg mb-4">⭐ {{ $task->name }}</h3>

                    <div class="flex gap-4 overflow-x-auto">
                        @for ($i = 0; $i < 7; $i++)
                            @php
                                $date = $startOfWeek->copy()->addDays($i);
                                $log = $task->logs->first(
                                    fn ($l) => $l->log_date->toDateString() === $date->toDateString()
                                );
                                $status = $log?->status;
                            @endphp

                            <div class="text-center">
                                <div class="text-xs text-gray-500 mb-1">
                                    {{ $date->format('d/m') }}
                                </div>

                                @if ($date->lessThanOrEqualTo($today))
                                    <div class="flex flex-col gap-1">
                                        <form method="POST" action="{{ route('tasks.status', $task) }}">
                                            @csrf
                                            <input type="hidden" name="date" value="{{ $date->toDateString() }}">
                                            <input type="hidden" name="status" value="success">
                                            <button class="w-8 h-4 rounded-lg shadow {{ $status==='success'?'bg-green-400':'bg-gray-200' }}"></button>
                                        </form>

                                        <form method="POST" action="{{ route('tasks.status', $task) }}">
                                            @csrf
                                            <input type="hidden" name="date" value="{{ $date->toDateString() }}">
                                            <input type="hidden" name="status" value="fail">
                                            <button class="w-8 h-4 rounded-lg shadow {{ $status==='fail'?'bg-red-400':'bg-gray-200' }}"></button>
                                        </form>
                                    </div>
                                @else
                                    <div class="w-8 h-8 rounded-xl bg-gray-100"></div>
                                @endif
                            </div>
                        @endfor
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</x-app-layout>
