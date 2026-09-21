<x-admin-layout>
    <x-slot name="title">
        Profil
    </x-slot>

    <div class="space-y-6">

        <div>
            <h1 class="text-2xl font-semibold tracking-tight text-slate-950">
                Profil
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Kelola informasi akun administrator Anda.
            </p>
        </div>

        <div class="grid gap-6 lg:grid-cols-[1fr_320px]">

            <div class="space-y-6">

                <div class="rounded-lg border border-slate-200 bg-white">
                    <div class="border-b border-slate-200 px-5 py-4">
                        <h2 class="text-sm font-semibold text-slate-900">
                            Informasi Profil
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Perbarui nama dan alamat email yang digunakan pada akun.
                        </p>
                    </div>

                    <form
                        method="POST"
                        action="{{ route('profile.update') }}"
                        class="space-y-5 p-5"
                    >
                        @csrf
                        @method('PATCH')

                        <div>
                            <label
                                for="name"
                                class="mb-1.5 block text-sm font-medium text-slate-700"
                            >
                                Nama
                            </label>

                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name', $user->name) }}"
                                required
                                autofocus
                                autocomplete="name"
                                class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                            >

                            @error('name')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="email"
                                class="mb-1.5 block text-sm font-medium text-slate-700"
                            >
                                Email
                            </label>

                            <input
                                id="email"
                                name="email"
                                type="email"
                                value="{{ old('email', $user->email) }}"
                                required
                                autocomplete="username"
                                class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                            >

                            @error('email')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex justify-end border-t border-slate-100 pt-5">
                            <button
                                type="submit"
                                class="inline-flex h-9 items-center justify-center rounded-md bg-slate-950 px-4 text-sm font-medium text-white transition hover:bg-slate-800"
                            >
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>

                <div class="rounded-lg border border-slate-200 bg-white">
                    <div class="border-b border-slate-200 px-5 py-4">
                        <h2 class="text-sm font-semibold text-slate-900">
                            Ubah Password
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Gunakan password baru yang kuat untuk menjaga keamanan akun.
                        </p>
                    </div>

                    <form
                        method="POST"
                        action="{{ route('password.update') }}"
                        class="space-y-5 p-5"
                    >
                        @csrf
                        @method('PUT')

                        <div>
                            <label
                                for="current_password"
                                class="mb-1.5 block text-sm font-medium text-slate-700"
                            >
                                Password Saat Ini
                            </label>

                            <input
                                id="current_password"
                                name="current_password"
                                type="password"
                                autocomplete="current-password"
                                class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                            >

                            @error('current_password', 'updatePassword')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="password"
                                class="mb-1.5 block text-sm font-medium text-slate-700"
                            >
                                Password Baru
                            </label>

                            <input
                                id="password"
                                name="password"
                                type="password"
                                autocomplete="new-password"
                                class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                            >

                            @error('password', 'updatePassword')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="password_confirmation"
                                class="mb-1.5 block text-sm font-medium text-slate-700"
                            >
                                Konfirmasi Password Baru
                            </label>

                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                autocomplete="new-password"
                                class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                            >

                            @error('password_confirmation', 'updatePassword')
                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex justify-end border-t border-slate-100 pt-5">
                            <button
                                type="submit"
                                class="inline-flex h-9 items-center justify-center rounded-md bg-slate-950 px-4 text-sm font-medium text-white transition hover:bg-slate-800"
                            >
                                Ubah Password
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            <div class="space-y-6">

                <div class="rounded-lg border border-slate-200 bg-white">
                    <div class="border-b border-slate-200 px-5 py-4">
                        <h2 class="text-sm font-semibold text-slate-900">
                            Detail Akun
                        </h2>
                    </div>

                    <div class="p-5">
                        <div class="flex flex-col items-center text-center">
                            <div class="flex h-20 w-20 items-center justify-center rounded-full bg-slate-100 text-2xl font-semibold uppercase text-slate-700">
                                {{ substr($user->name, 0, 1) }}
                            </div>

                            <h3 class="mt-4 text-base font-semibold text-slate-900">
                                {{ $user->name }}
                            </h3>

                            <p class="mt-1 break-all text-sm text-slate-500">
                                {{ $user->email }}
                            </p>

                            <span class="mt-3 inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-medium capitalize text-slate-700">
                                {{ $user->role }}
                            </span>
                        </div>

                        <div class="mt-6 space-y-4 border-t border-slate-100 pt-5">

                            <div>
                                <p class="text-xs text-slate-400">
                                    Akun dibuat
                                </p>

                                <p class="mt-1 text-sm font-medium text-slate-700">
                                    {{ $user->created_at?->format('d F Y, H:i') ?? '—' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-xs text-slate-400">
                                    Terakhir diperbarui
                                </p>

                                <p class="mt-1 text-sm font-medium text-slate-700">
                                    {{ $user->updated_at?->format('d F Y, H:i') ?? '—' }}
                                </p>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="rounded-lg border border-red-200 bg-white">
                    <div class="border-b border-red-100 px-5 py-4">
                        <h2 class="text-sm font-semibold text-red-700">
                            Hapus Akun
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Tindakan ini bersifat permanen dan tidak dapat dibatalkan.
                        </p>
                    </div>

                    <div class="p-5">
                        <form
                            method="POST"
                            action="{{ route('profile.destroy') }}"
                            onsubmit="return confirm('Yakin ingin menghapus akun Anda? Tindakan ini tidak dapat dibatalkan.')"
                        >
                            @csrf
                            @method('DELETE')

                            <div>
                                <label
                                    for="delete_password"
                                    class="mb-1.5 block text-sm font-medium text-slate-700"
                                >
                                    Password
                                </label>

                                <input
                                    id="delete_password"
                                    name="password"
                                    type="password"
                                    required
                                    placeholder="Masukkan password"
                                    class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                                >

                                @error('password', 'userDeletion')
                                    <p class="mt-1.5 text-xs text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <button
                                type="submit"
                                class="mt-4 inline-flex h-9 w-full items-center justify-center rounded-md border border-red-200 bg-red-50 px-4 text-sm font-medium text-red-600 transition hover:bg-red-100"
                            >
                                Hapus Akun
                            </button>
                        </form>
                    </div>
                </div>

            </div>

        </div>

    </div>
</x-admin-layout>
