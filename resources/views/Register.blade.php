<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register | Dream Cat</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/616/616408.png" />
</head>

<body class="bg-gradient-to-br from-yellow-50 to-orange-100 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-xl rounded-3xl w-full max-w-md p-8 relative border border-orange-200">
        <div class="text-center mb-6">
            <img src="https://cdn-icons-png.flaticon.com/512/616/616408.png" alt="logo dream cat" class="mx-auto w-20 h-20 mb-2">
            <h1 class="text-3xl font-bold text-orange-700">Daftar Dream Cat</h1>
            <p class="text-sm text-gray-500">Silakan isi formulir untuk membuat akun</p>
        </div>

        {{-- Error & Success Messages --}}
        @if ($errors->any())
            <div class="mb-4 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-lg">
                <ul class="list-disc list-inside text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session()->has('success'))
            <div class="mb-5 p-4 rounded-lg shadow-sm bg-green-100 border border-green-300 text-green-800 relative">
                <span>{{ session('success') }}</span>
                <button type="button" class="absolute top-2 right-3 text-green-600 hover:text-green-800"
                    onclick="this.parentElement.remove()">
                    &times;
                </button>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400" required>
            </div>
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" placeholder="email@example.com"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400" required>
            </div>
            
            <div>
                <label for="role" class="block text-sm font-medium text-gray-700">Pilih Role</label>
                <select id="role" name="role"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400" required>
                    <option value="admin">Admin</option>
                    <option value="kasir">Kasir</option>
                </select>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Kata Sandi</label>
                <input type="password" id="password" name="password" placeholder="Masukkan kata sandi"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400" required>
            </div>
            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Konfirmasi Kata Sandi</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi"
                    class="mt-1 w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-400" required>
            </div>

            <button type="submit"
                class="w-full bg-orange-600 hover:bg-orange-700 text-white font-semibold py-2 rounded-lg transition duration-300">
                Daftar
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-4">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="text-orange-600 hover:underline font-medium">Masuk di sini</a>
        </p>
    </div>

</body>

</html>
