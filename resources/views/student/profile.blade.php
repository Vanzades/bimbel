<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bimbel') }} — Profil Siswa</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-950 antialiased">
    <header class="sticky top-0 z-30 border-b border-slate-200 bg-white">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <a href="{{ route('student.dashboard') }}" class="flex items-center gap-3">
                <div class="flex h-8 w-8 items-center justify-center rounded-md bg-slate-950 text-sm font-bold text-white">
                    B
                </div>

                <div>
                    <div class="text-sm font-semibold text-slate-950">
                        Bimbel
                    </div>

                    <div class="text-xs text-slate-500">
                        Student Portal
                    </div>
                </div>
            </a>

            <div class="flex items-center gap-4">
                <div class="hidden text-right sm:block">
                    <div class="text-sm font-medium text-slate-900">
                        {{ $student->name }}
                    </div>

                    <div class="text-xs text-slate-500">
                        Siswa
                    </div>
                </div>

                <div class="flex h-9 w-9 items-center justify-center rounded-full bg-slate-100 text-sm font-semibold text-slate-700">
                    {{ strtoupper(substr($student->name, 0, 1)) }}
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="text-sm font-medium text-slate-500 transition hover:text-slate-950"
                    >
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </header>

    <main class="mx-auto w-full max-w-7xl px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
        <div class="mx-auto max-w-4xl space-y-6">
            <div>
                <a
                    href="{{ route('student.dashboard') }}"
                    class="text-sm font-medium text-slate-500 transition hover:text-slate-950"
                >
                    ← Kembali ke Dashboard
                </a>

                <div class="mt-5">
                    <p class="text-sm font-medium text-slate-500">
                        Student Portal
                    </p>

                    <h1 class="mt-1 text-2xl font-semibold tracking-tight text-slate-950">
                        Profil Siswa
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        Kelola informasi pribadi yang terdaftar pada sistem.
                    </p>
                </div>
            </div>

            @if (session('success'))
                <div class="border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="border border-red-200 bg-red-50 px-4 py-3">
                    <ul class="space-y-1 text-sm text-red-700">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="grid gap-6 lg:grid-cols-[1fr_1.5fr]">
                <section class="border border-slate-200 bg-white p-6">
                    <div class="flex flex-col items-center text-center">
                        <div class="flex h-20 w-20 items-center justify-center rounded-full bg-slate-100 text-2xl font-semibold text-slate-700">
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </div>

                        <h2 class="mt-4 text-lg font-semibold text-slate-950">
                            {{ $student->name }}
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $student->identity_number }}
                        </p>

                        <span class="{{ $student->status === 'active'
                            ? 'bg-emerald-50 text-emerald-700'
                            : 'bg-slate-100 text-slate-600' }}
                            mt-4 rounded-full px-3 py-1 text-xs font-medium"
                        >
                            {{ $student->status === 'active' ? 'Siswa Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>

                    <div class="mt-6 border-t border-slate-100 pt-5">
                        <div class="flex items-center justify-between gap-4 py-2">
                            <span class="text-sm text-slate-500">
                                NIS
                            </span>

                            <span class="text-sm font-medium text-slate-900">
                                {{ $student->identity_number }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between gap-4 py-2">
                            <span class="text-sm text-slate-500">
                                Kelas
                            </span>

                            <span class="text-sm font-medium text-slate-900">
                                {{ $student->classRoom->name ?? '-' }}
                            </span>
                        </div>

                        <div class="flex items-center justify-between gap-4 py-2">
                            <span class="text-sm text-slate-500">
                                Jenis Kelamin
                            </span>

                            <span class="text-sm font-medium text-slate-900">
                                {{ $student->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}
                            </span>
                        </div>
                    </div>
                </section>

                <section class="border border-slate-200 bg-white">
                    <div class="border-b border-slate-200 px-6 py-5">
                        <h2 class="text-base font-semibold text-slate-950">
                            Informasi Pribadi
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Perbarui informasi pribadi kamu.
                        </p>
                    </div>

                    <form
                        method="POST"
                        action="{{ route('student.profile.update') }}"
                        class="space-y-5 p-6"
                    >
                        @csrf
                        @method('PATCH')

                        <div>
                            <label
                                for="name"
                                class="mb-2 block text-sm font-medium text-slate-700"
                            >
                                Nama Lengkap
                            </label>

                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name', $student->name) }}"
                                required
                                class="block w-full border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-950 focus:ring-1 focus:ring-slate-950"
                            >
                        </div>

                        <div>
                            <label
                                for="gender"
                                class="mb-2 block text-sm font-medium text-slate-700"
                            >
                                Jenis Kelamin
                            </label>

                            <select
                                id="gender"
                                name="gender"
                                required
                                class="block w-full border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition focus:border-slate-950 focus:ring-1 focus:ring-slate-950"
                            >
                                <option value="male" @selected(old('gender', $student->gender) === 'male')>
                                    Laki-laki
                                </option>

                                <option value="female" @selected(old('gender', $student->gender) === 'female')>
                                    Perempuan
                                </option>
                            </select>
                        </div>

                        <div>
                            <label
                                for="phone"
                                class="mb-2 block text-sm font-medium text-slate-700"
                            >
                                Nomor Telepon
                            </label>

                            <input
                                id="phone"
                                name="phone"
                                type="text"
                                value="{{ old('phone', $student->phone) }}"
                                class="block w-full border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-950 focus:ring-1 focus:ring-slate-950"
                            >
                        </div>

                        <div>
                            <label
                                for="address"
                                class="mb-2 block text-sm font-medium text-slate-700"
                            >
                                Alamat
                            </label>

                            <textarea
                                id="address"
                                name="address"
                                rows="4"
                                class="block w-full resize-none border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-950 focus:ring-1 focus:ring-slate-950"
                            >{{ old('address', $student->address) }}</textarea>
                        </div>

                        <div class="flex justify-end border-t border-slate-100 pt-5">
                            <button
                                type="submit"
                                class="bg-slate-950 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-slate-800"
                            >
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </main>
</body>
</html>
