<x-cartoon-layout>
    <div class="text-center space-y-8 py-10">

        <h2 class="text-4xl font-extrabold text-indigo-700">
            🌱 Selamat Datang
        </h2>

        <p class="text-gray-500 max-w-xl mx-auto">
            Ini adalah ruang aman untuk membangun kebiasaan baru.
            Tidak harus sempurna, yang penting konsisten.
        </p>

        <div class="flex justify-center gap-4">
            <a href="{{ route('login') }}"
               class="px-6 py-3 rounded-full bg-indigo-500 text-white font-bold shadow hover:bg-indigo-600">
                Login 🚀
            </a>

            <a href="{{ route('register') }}"
               class="px-6 py-3 rounded-full bg-white text-indigo-600 font-bold border shadow hover:bg-gray-50">
                Daftar ✨
            </a>
        </div>

        <p class="text-sm text-gray-400 mt-6">
            Kamu perlu login untuk mulai mencatat aktivitas 🌱
        </p>

    </div>
</x-cartoon-layout>
