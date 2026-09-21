<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bimbel') }} — SPP Siswa</title>

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
        <div class="space-y-6">
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
                        SPP
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        Lihat tagihan dan riwayat pembayaran SPP kamu.
                    </p>
                </div>
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
                </div>
            </div>

            <section class="border border-slate-200 bg-white">
                <div class="border-b border-slate-200 px-5 py-4">
                    <h2 class="text-sm font-semibold text-slate-950">
                        Filter Tagihan
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Filter berdasarkan status atau tahun pembayaran.
                    </p>
                </div>

                <form
                    method="GET"
                    action="{{ route('student.spp') }}"
                    class="grid gap-4 p-5 sm:grid-cols-3"
                >
                    <div>
                        <label
                            for="status"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="block w-full border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none focus:border-slate-950 focus:ring-1 focus:ring-slate-950"
                        >
                            <option value="">Semua Status</option>

                            <option value="paid" @selected(request('status') === 'paid')>
                                Lunas
                            </option>

                            <option value="unpaid" @selected(request('status') === 'unpaid')>
                                Belum Lunas
                            </option>

                            <option value="pending" @selected(request('status') === 'pending')>
                                Menunggu Pembayaran
                            </option>

                            <option value="failed" @selected(request('status') === 'failed')>
                                Gagal
                            </option>

                            <option value="expired" @selected(request('status') === 'expired')>
                                Expired
                            </option>
                        </select>
                    </div>

                    <div>
                        <label
                            for="year"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Tahun
                        </label>

                        <select
                            id="year"
                            name="year"
                            class="block w-full border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none focus:border-slate-950 focus:ring-1 focus:ring-slate-950"
                        >
                            <option value="">Semua Tahun</option>

                            @foreach ($years as $year)
                                <option
                                    value="{{ $year }}"
                                    @selected((string) request('year') === (string) $year)
                                >
                                    {{ $year }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-end gap-2">
                        <button
                            type="submit"
                            class="bg-slate-950 px-4 py-2.5 text-sm font-medium text-white transition hover:bg-slate-800"
                        >
                            Terapkan Filter
                        </button>

                        <a
                            href="{{ route('student.spp') }}"
                            class="border border-slate-300 bg-white px-4 py-2.5 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
                        >
                            Reset
                        </a>
                    </div>
                </form>
            </section>

            <section class="border border-slate-200 bg-white">
                <div class="border-b border-slate-200 px-5 py-4">
                    <h2 class="text-sm font-semibold text-slate-950">
                        Daftar Tagihan SPP
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Seluruh tagihan SPP yang terdaftar atas nama kamu.
                    </p>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="border-b border-slate-200 bg-slate-50">
                            <tr>
                                <th class="whitespace-nowrap px-5 py-3 font-medium text-slate-500">
                                    Periode
                                </th>

                                <th class="whitespace-nowrap px-5 py-3 font-medium text-slate-500">
                                    Jumlah
                                </th>

                                <th class="whitespace-nowrap px-5 py-3 font-medium text-slate-500">
                                    Status
                                </th>

                                <th class="whitespace-nowrap px-5 py-3 font-medium text-slate-500">
                                    Dibayar
                                </th>

                                <th class="whitespace-nowrap px-5 py-3 text-right font-medium text-slate-500">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-slate-100">
                            @forelse ($sppBills as $sppBill)
                                <tr class="transition hover:bg-slate-50">
                                    <td class="whitespace-nowrap px-5 py-4">
                                        <div class="font-medium text-slate-900">
                                            {{ $sppBill->period }}
                                        </div>

                                        <div class="mt-0.5 text-xs text-slate-500">
                                            {{ $sppBill->created_at->translatedFormat('d F Y') }}
                                        </div>
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 font-medium text-slate-900">
                                        Rp {{ number_format($sppBill->amount, 0, ',', '.') }}
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4">
                                        <span class="{{ match ($sppBill->status) {
                                            'paid' => 'bg-emerald-50 text-emerald-700',
                                            'pending' => 'bg-blue-50 text-blue-700',
                                            'failed' => 'bg-red-50 text-red-700',
                                            'expired' => 'bg-slate-100 text-slate-600',
                                            default => 'bg-amber-50 text-amber-700',
                                        } }} rounded-full px-2.5 py-1 text-xs font-medium">
                                            {{ match ($sppBill->status) {
                                                'paid' => 'Lunas',
                                                'pending' => 'Menunggu Pembayaran',
                                                'failed' => 'Gagal',
                                                'expired' => 'Expired',
                                                default => 'Belum Lunas',
                                            } }}
                                        </span>
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                        {{ $sppBill->paid_at
                                            ? $sppBill->paid_at->translatedFormat('d F Y, H:i')
                                            : '-' }}
                                    </td>

                                    <td class="whitespace-nowrap px-5 py-4 text-right">
                                        <a
                                            href="{{ route('student.spp.show', $sppBill->id) }}"
                                            class="text-sm font-medium text-slate-700 transition hover:text-slate-950"
                                        >
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td
                                        colspan="5"
                                        class="px-5 py-12 text-center"
                                    >
                                        <p class="text-sm font-medium text-slate-700">
                                            Belum ada tagihan SPP
                                        </p>

                                        <p class="mt-1 text-sm text-slate-500">
                                            Tagihan SPP kamu akan muncul di halaman ini.
                                        </p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($sppBills->hasPages())
                    <div class="border-t border-slate-200 px-5 py-4">
                        {{ $sppBills->links() }}
                    </div>
                @endif
            </section>
        </div>
    </main>
</body>
</html>
