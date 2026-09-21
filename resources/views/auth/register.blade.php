<x-guest-layout>
    <div class="min-h-screen">
        <div class="grid min-h-screen lg:grid-cols-2">

            <div class="hidden bg-slate-950 lg:flex lg:flex-col lg:justify-between lg:p-12 xl:p-16">
                <div>
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
                        <div class="flex h-9 w-9 items-center justify-center rounded-md bg-white text-sm font-bold text-slate-950">
                            B
                        </div>

                        <div>
                            <div class="text-sm font-semibold text-white">
                                Bimbel
                            </div>

                            <div class="text-xs text-slate-400">
                                Sistem Informasi Bimbingan Belajar
                            </div>
                        </div>
                    </a>
                </div>

                <div class="max-w-xl">
                    <p class="text-sm font-medium text-slate-400">
                        Sistem Informasi Bimbingan Belajar
                    </p>

                    <h1 class="mt-5 text-4xl font-semibold leading-tight tracking-tight text-white xl:text-6xl">
                        Bergabung dengan sistem bimbingan belajar.
                    </h1>

                    <p class="mt-6 max-w-lg text-base leading-7 text-slate-400">
                        Buat akun untuk mengakses layanan dan informasi
                        yang tersedia di sistem bimbingan belajar.
                    </p>
                </div>

                <p class="text-xs text-slate-500">
                    &copy; {{ date('Y') }} Bimbel
                </p>
            </div>

            <div class="flex min-h-screen items-center justify-center bg-white px-5 py-10 sm:px-8 lg:px-12">
                <div class="w-full max-w-md">

                    <div class="mb-10 lg:hidden">
                        <a href="{{ url('/') }}" class="inline-flex items-center gap-3">
                            <div class="flex h-9 w-9 items-center justify-center rounded-md bg-slate-950 text-sm font-bold text-white">
                                B
                            </div>

                            <div>
                                <div class="text-sm font-semibold text-slate-950">
                                    Bimbel
                                </div>

                                <div class="text-xs text-slate-500">
                                    Sistem Informasi Bimbingan Belajar
                                </div>
                            </div>
                        </a>
                    </div>

                    <div>
                        <div class="mb-8">
                            <p class="text-sm font-medium text-slate-500">
                                Buat akun
                            </p>

                            <h2 class="mt-2 text-3xl font-semibold tracking-tight text-slate-950">
                                Daftar akun
                            </h2>

                            <p class="mt-3 text-sm leading-6 text-slate-500">
                                Lengkapi data berikut untuk membuat akun baru.
                            </p>
                        </div>

                        <form method="POST" action="{{ route('register') }}" class="space-y-5">
                            @csrf

                            <div>
                                <x-input-label
                                    for="name"
                                    :value="'Nama'"
                                    class="mb-2 text-sm font-medium text-slate-700"
                                />

                                <x-text-input
                                    id="name"
                                    class="block w-full border-slate-300 bg-white px-3 py-2.5 text-sm shadow-none focus:border-slate-950 focus:ring-slate-950"
                                    type="text"
                                    name="name"
                                    :value="old('name')"
                                    required
                                    autofocus
                                    autocomplete="name"
                                    placeholder="Nama lengkap"
                                />

                                <x-input-error
                                    :messages="$errors->get('name')"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <x-input-label
                                    for="email"
                                    :value="'Email'"
                                    class="mb-2 text-sm font-medium text-slate-700"
                                />

                                <x-text-input
                                    id="email"
                                    class="block w-full border-slate-300 bg-white px-3 py-2.5 text-sm shadow-none focus:border-slate-950 focus:ring-slate-950"
                                    type="email"
                                    name="email"
                                    :value="old('email')"
                                    required
                                    autocomplete="username"
                                    placeholder="nama@email.com"
                                />

                                <x-input-error
                                    :messages="$errors->get('email')"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <x-input-label
                                    for="password"
                                    :value="'Password'"
                                    class="mb-2 text-sm font-medium text-slate-700"
                                />

                                <x-text-input
                                    id="password"
                                    class="block w-full border-slate-300 bg-white px-3 py-2.5 text-sm shadow-none focus:border-slate-950 focus:ring-slate-950"
                                    type="password"
                                    name="password"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Minimal 8 karakter"
                                />

                                <x-input-error
                                    :messages="$errors->get('password')"
                                    class="mt-2"
                                />
                            </div>

                            <div>
                                <x-input-label
                                    for="password_confirmation"
                                    :value="'Konfirmasi Password'"
                                    class="mb-2 text-sm font-medium text-slate-700"
                                />

                                <x-text-input
                                    id="password_confirmation"
                                    class="block w-full border-slate-300 bg-white px-3 py-2.5 text-sm shadow-none focus:border-slate-950 focus:ring-slate-950"
                                    type="password"
                                    name="password_confirmation"
                                    required
                                    autocomplete="new-password"
                                    placeholder="Ulangi password"
                                />

                                <x-input-error
                                    :messages="$errors->get('password_confirmation')"
                                    class="mt-2"
                                />
                            </div>

                            <button
                                type="submit"
                                class="inline-flex w-full items-center justify-center bg-slate-950 px-4 py-3 text-sm font-medium text-white transition hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-950 focus:ring-offset-2"
                            >
                                Daftar
                            </button>
                        </form>

                        <div class="mt-8 border-t border-slate-200 pt-6 text-center">
                            <p class="text-sm text-slate-500">
                                Sudah memiliki akun?
                                <a
                                    href="{{ route('login') }}"
                                    class="font-medium text-slate-950 hover:underline"
                                >
                                    Masuk
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="mt-6 text-center">
                        <a
                            href="{{ url('/') }}"
                            class="text-sm text-slate-500 transition hover:text-slate-950"
                        >
                            Kembali ke halaman utama
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-guest-layout>
