<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bimbel') }} — Dashboard Siswa</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-slate-50 text-slate-950 antialiased">
    <div class="min-h-screen">
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
            <div class="space-y-8">
                <section>
                    <p class="text-sm font-medium text-slate-500">
                        Student Portal
                    </p>

                    <h1 class="mt-1 text-2xl font-semibold tracking-tight text-slate-950">
                        Selamat datang, {{ $student->name }}
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        Pantau informasi kelas dan pembayaran SPP kamu di sini.
                    </p>
                </section>

                <section class="border border-slate-200 bg-white p-5 sm:p-6">
                    <div class="flex flex-col gap-5 sm:flex-row sm:items-center">
                        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-full bg-slate-100 text-lg font-semibold text-slate-700">
                            {{ strtoupper(substr($student->name, 0, 1)) }}
                        </div>

                        <div class="min-w-0 flex-1">
                            <h2 class="text-lg font-semibold text-slate-950">
                                {{ $student->name }}
                            </h2>

                            <div class="mt-2 flex flex-wrap gap-x-6 gap-y-2 text-sm text-slate-500">
                                <span>
                                    NIS:
                                    <span class="font-medium text-slate-700">
                                        {{ $student->identity_number }}
                                    </span>
                                </span>

                                <span>
                                    Kelas:
                                    <span class="font-medium text-slate-700">
                                        {{ $student->classRoom->name ?? '-' }}
                                    </span>
                                </span>

                                <span>
                                    Status:
                                    <span class="font-medium {{ $student->status === 'active' ? 'text-emerald-600' : 'text-slate-500' }}">
                                        {{ $student->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </section>

                <section>
                    <div class="mb-4">
                        <h2 class="text-lg font-semibold text-slate-950">
                            Ringkasan SPP
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            Status pembayaran tagihan SPP kamu.
                        </p>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                        <div class="border border-slate-200 bg-white p-5">
                            <p class="text-sm font-medium text-slate-500">
                                Total Tagihan
                            </p>

                            <p class="mt-2 text-2xl font-semibold text-slate-950">
                                {{ $sppStats['total'] }}
                            </p>
                        </div>

                        <div class="border border-emerald-200 bg-emerald-50 p-5">
                            <p class="text-sm font-medium text-emerald-700">
                                Lunas
                            </p>

                            <p class="mt-2 text-2xl font-semibold text-emerald-800">
                                {{ $sppStats['paid'] }}
                            </p>

                            <p class="mt-1 text-xs text-emerald-700">
                                Rp {{ number_format($sppStats['paidAmount'], 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="border border-amber-200 bg-amber-50 p-5">
                            <p class="text-sm font-medium text-amber-700">
                                Belum Lunas
                            </p>

                            <p class="mt-2 text-2xl font-semibold text-amber-800">
                                {{ $sppStats['unpaid'] }}
                            </p>

                            <p class="mt-1 text-xs text-amber-700">
                                Rp {{ number_format($sppStats['unpaidAmount'], 0, ',', '.') }}
                            </p>
                        </div>

                        <div class="border border-blue-200 bg-blue-50 p-5">
                            <p class="text-sm font-medium text-blue-700">
                                Menunggu
                            </p>

                            <p class="mt-2 text-2xl font-semibold text-blue-800">
                                {{ $sppStats['pending'] }}
                            </p>

                            <p class="mt-1 text-xs text-blue-700">
                                Pembayaran diproses
                            </p>
                        </div>
                    </div>
                </section>

                <section class="grid gap-6 lg:grid-cols-[1.5fr_1fr]">
                    <div class="border border-slate-200 bg-white">
                        <div class="border-b border-slate-200 px-5 py-4">
                            <h2 class="text-sm font-semibold text-slate-950">
                                Tagihan SPP Terakhir
                            </h2>

                            <p class="mt-1 text-xs text-slate-500">
                                Informasi tagihan terbaru.
                            </p>
                        </div>

                        @if ($latestSppBill)
                            <div class="p-5">
                                <div class="flex flex-col gap-5 sm:flex-row sm:items-start sm:justify-between">
                                    <div>
                                        <p class="text-sm text-slate-500">
                                            Periode
                                        </p>

                                        <p class="mt-1 text-lg font-semibold text-slate-950">
                                            {{ $latestSppBill->period }}
                                        </p>
                                    </div>

                                    <span class="{{ match ($latestSppBill->status) {
                                        'paid' => 'bg-emerald-50 text-emerald-700',
                                        'pending' => 'bg-blue-50 text-blue-700',
                                        'failed' => 'bg-red-50 text-red-700',
                                        'expired' => 'bg-slate-100 text-slate-600',
                                        default => 'bg-amber-50 text-amber-700',
                                    } }} rounded-full px-2.5 py-1 text-xs font-medium">
                                        {{ match ($latestSppBill->status) {
                                            'paid' => 'Lunas',
                                            'pending' => 'Menunggu Pembayaran',
                                            'failed' => 'Gagal',
                                            'expired' => 'Expired',
                                            default => 'Belum Lunas',
                                        } }}
                                    </span>
                                </div>

                                <div class="mt-6 border-t border-slate-100 pt-5">
                                    <p class="text-sm text-slate-500">
                                        Jumlah Tagihan
                                    </p>

                                    <p class="mt-1 text-2xl font-semibold text-slate-950">
                                        Rp {{ number_format($latestSppBill->amount, 0, ',', '.') }}
                                    </p>
                                </div>

                                @if ($latestSppBill->paid_at)
                                    <div class="mt-4 text-sm text-slate-500">
                                        Dibayar pada
                                        <span class="font-medium text-slate-700">
                                            {{ $latestSppBill->paid_at->translatedFormat('d F Y, H:i') }}
                                        </span>
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="px-5 py-12 text-center">
                                <p class="text-sm font-medium text-slate-700">
                                    Belum ada tagihan SPP
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    Data tagihan SPP kamu akan muncul di sini.
                                </p>
                            </div>
                        @endif
                    </div>

                    <div class="border border-slate-200 bg-white">
                        <div class="border-b border-slate-200 px-5 py-4">
                            <h2 class="text-sm font-semibold text-slate-950">
                                Informasi Siswa
                            </h2>

                            <p class="mt-1 text-xs text-slate-500">
                                Data akademik kamu.
                            </p>
                        </div>

                        <div class="divide-y divide-slate-100">
                            <div class="flex items-center justify-between gap-4 px-5 py-4">
                                <span class="text-sm text-slate-500">
                                    Nama
                                </span>

                                <span class="text-right text-sm font-medium text-slate-900">
                                    {{ $student->name }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between gap-4 px-5 py-4">
                                <span class="text-sm text-slate-500">
                                    NIS
                                </span>

                                <span class="text-right text-sm font-medium text-slate-900">
                                    {{ $student->identity_number }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between gap-4 px-5 py-4">
                                <span class="text-sm text-slate-500">
                                    Kelas
                                </span>

                                <span class="text-right text-sm font-medium text-slate-900">
                                    {{ $student->classRoom->name ?? '-' }}
                                </span>
                            </div>

                            <div class="flex items-center justify-between gap-4 px-5 py-4">
                                <span class="text-sm text-slate-500">
                                    Status
                                </span>

                                <span class="text-right text-sm font-medium {{ $student->status === 'active' ? 'text-emerald-600' : 'text-slate-500' }}">
                                    {{ $student->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="border border-slate-200 bg-white">
                    <div class="border-b border-slate-200 px-5 py-4">
                        <h2 class="text-sm font-semibold text-slate-950">
                            Menu Siswa
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Akses fitur student portal.
                        </p>
                    </div>

                    <div class="grid gap-px bg-slate-200 sm:grid-cols-3">
                        <a
                            href="{{ route('student.profile') }}"
                            class="bg-white p-5 transition hover:bg-slate-50"
                        >
                            <div class="flex h-9 w-9 items-center justify-center rounded-md bg-slate-100 text-slate-600">
                                <svg
                                    class="h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M22 21v-2a4 4 0 0 0-3-3.87"/>
                                    <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                                </svg>
                            </div>

                            <h3 class="mt-4 text-sm font-semibold text-slate-900">
                                Profil
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Kelola informasi profil siswa.
                            </p>
                        </a>

                        <a
                            href="{{ route('student.attendance') }}"
                            class="bg-white p-5 transition hover:bg-slate-50"
                        >
                            <div class="flex h-9 w-9 items-center justify-center rounded-md bg-slate-100 text-slate-600">
                                <svg
                                    class="h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <rect x="3" y="4" width="18" height="18" rx="2"/>
                                    <path d="M16 2v4"/>
                                    <path d="M8 2v4"/>
                                    <path d="M3 10h18"/>
                                </svg>
                            </div>

                            <h3 class="mt-4 text-sm font-semibold text-slate-900">
                                Absensi
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Lihat riwayat kehadiran belajar.
                            </p>
                        </a>

                        <a
                            href="{{ route('student.spp') }}"
                            class="bg-white p-5 transition hover:bg-slate-50"
                        >
                            <div class="flex h-9 w-9 items-center justify-center rounded-md bg-slate-100 text-slate-600">
                                <svg
                                    class="h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <rect x="3" y="4" width="18" height="16" rx="2"/>
                                    <path d="M7 8h10"/>
                                    <path d="M7 12h10"/>
                                    <path d="M7 16h6"/>
                                </svg>
                            </div>

                            <h3 class="mt-4 text-sm font-semibold text-slate-900">
                                SPP
                            </h3>

                            <p class="mt-1 text-sm text-slate-500">
                                Lihat tagihan dan riwayat pembayaran.
                            </p>
                        </a>
                    </div>
                </section>
            </div>
        </main>
    </div>
</body>
</html>