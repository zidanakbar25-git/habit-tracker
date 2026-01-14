<x-cartoon-layout>
    <div class="max-w-md mx-auto text-center space-y-6">

        <h2 class="text-2xl font-extrabold text-indigo-700">
            ✨ Mulai Perjalanan Baru
        </h2>

        <p class="text-gray-500">
            Tidak perlu sempurna, yang penting mulai 🌱
        </p>

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <input type="text" name="name" placeholder="🙋 Nama"
                class="w-full rounded-full border-gray-300 px-4 py-3"
                required>

            <input type="email" name="email" placeholder="📧 Email"
                class="w-full rounded-full border-gray-300 px-4 py-3"
                required>

            <input type="password" name="password" placeholder="🔑 Password"
                class="w-full rounded-full border-gray-300 px-4 py-3"
                required>

            <input type="password" name="password_confirmation" placeholder="🔁 Ulangi Password"
                class="w-full rounded-full border-gray-300 px-4 py-3"
                required>

            <button
                class="w-full bg-indigo-500 hover:bg-indigo-600 text-white py-3 rounded-full font-bold shadow">
                Daftar 🌱
            </button>
        </form>

        <p class="text-sm text-gray-500">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-indigo-600 font-semibold">
                Login 🚀
            </a>
        </p>
    </div>
</x-cartoon-layout>
