<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-extrabold text-indigo-700">
            🌱 Kegiatan Kamu
        </h2>
        <p class="text-sm text-gray-500">
            Pilih kegiatan, lanjutkan pelan-pelan ✨
        </p>
    </x-slot>

    <div class="py-6 max-w-6xl mx-auto px-4 space-y-8">

        <!-- FORM TAMBAH ACTIVITY -->
        <form method="POST" action="{{ route('activities.store') }}"
              class="bg-white rounded-2xl shadow-md p-6 space-y-4">
            @csrf

            <h3 class="font-bold text-lg text-indigo-700">
                ➕ Tambah Kegiatan Baru
            </h3>

            <input
                type="text"
                name="name"
                placeholder="Contoh: Olahraga, Kurangi Rokok"
                class="w-full rounded-full border-gray-300 px-4 py-3"
                required
            >

            <input
                type="date"
                name="start_date"
                class="rounded-full border-gray-300 px-4 py-2"
                required
            >

            <button
                class="bg-indigo-500 hover:bg-indigo-600 text-white px-6 py-3 rounded-full font-bold shadow">
                Mulai 🌱
            </button>
        </form>

        <!-- LIST ACTIVITY -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
            @forelse ($activities as $activity)
                <a href="{{ route('activities.show', $activity) }}">
                    <div class="bg-white rounded-2xl shadow-md p-6 hover:scale-[1.02] transition">
                        <h3 class="text-xl font-bold text-indigo-700">
                            ⭐ {{ $activity->name }}
                        </h3>
                        <p class="text-sm text-gray-500 mt-1">
                            Mulai: {{ \Carbon\Carbon::parse($activity->start_date)->format('d M Y') }}
                        </p>
                        <p class="text-xs text-gray-400 mt-2">
                            Klik untuk lanjutkan →
                        </p>
                    </div>
                </a>
            @empty
                <div class="col-span-full text-center text-gray-500">
                    <p class="text-lg">Belum ada kegiatan 🌱</p>
                    <p class="text-sm">Tambahkan satu untuk mulai perjalananmu</p>
                </div>
            @endforelse
        </div>

    </div>
</x-app-layout>
