<x-cartoon-layout>
    <div class="max-w-md mx-auto text-center space-y-6">

        <h2 class="text-2xl font-extrabold text-indigo-700">
            👋 Selamat datang kembali
        </h2>

        <p class="text-gray-500">
            Masuk dulu, kita lanjut pelan-pelan 🌱
        </p>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <input type="email" name="email" placeholder="📧 Email"
                class="w-full rounded-full border-gray-300 px-4 py-3 focus:ring-indigo-400"
                required autofocus>

            <input type="password" name="password" placeholder="🔑 Password"
                class="w-full rounded-full border-gray-300 px-4 py-3 focus:ring-indigo-400"
                required>

            <button
                class="w-full bg-indigo-500 hover:bg-indigo-600 text-white py-3 rounded-full font-bold shadow">
                Masuk 🚀
            </button>
        </form>

        <p class="text-sm text-gray-500">
            Belum punya akun?
            <a href="{{ route('register') }}" class="text-indigo-600 font-semibold">
                Daftar di sini ✨
            </a>
        </p>
    </div>
</x-cartoon-layout>
