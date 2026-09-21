<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Bimbel') }} — Detail SPP</title>

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

    <main class="mx-auto w-full max-w-5xl px-4 py-6 sm:px-6 lg:px-8 lg:py-8">
        <div class="space-y-6">
            <div>
                <a
                    href="{{ route('student.spp') }}"
                    class="text-sm font-medium text-slate-500 transition hover:text-slate-950"
                >
                    ← Kembali ke SPP
                </a>

                <div class="mt-5">
                    <p class="text-sm font-medium text-slate-500">
                        Student Portal
                    </p>

                    <h1 class="mt-1 text-2xl font-semibold tracking-tight text-slate-950">
                        Detail Tagihan SPP
                    </h1>
                </div>
            </div>

            <section class="border border-slate-200 bg-white">
                <div class="flex flex-col gap-4 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-slate-500">
                            Periode
                        </p>

                        <h2 class="mt-1 text-xl font-semibold text-slate-950">
                            {{ $sppBill->period }}
                        </h2>
                    </div>

                    <span class="{{ match ($sppBill->status) {
                        'paid' => 'bg-emerald-50 text-emerald-700',
                        'pending' => 'bg-blue-50 text-blue-700',
                        'failed' => 'bg-red-50 text-red-700',
                        'expired' => 'bg-slate-100 text-slate-600',
                        default => 'bg-amber-50 text-amber-700',
                    } }} w-fit rounded-full px-3 py-1.5 text-xs font-medium">
                        {{ match ($sppBill->status) {
                            'paid' => 'Lunas',
                            'pending' => 'Menunggu Pembayaran',
                            'failed' => 'Gagal',
                            'expired' => 'Expired',
                            default => 'Belum Lunas',
                        } }}
                    </span>
                </div>

                <div class="grid gap-6 p-6 sm:grid-cols-2">
                    <div>
                        <p class="text-sm text-slate-500">
                            Nama Siswa
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-900">
                            {{ $student->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">
                            NIS
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-900">
                            {{ $student->identity_number }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">
                            Kelas
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-900">
                            {{ $student->classRoom->name ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">
                            Periode
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-900">
                            {{ $sppBill->period }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">
                            Jumlah Tagihan
                        </p>

                        <p class="mt-1 text-xl font-semibold text-slate-950">
                            Rp {{ number_format($sppBill->amount, 0, ',', '.') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">
                            Tanggal Dibuat
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-900">
                            {{ $sppBill->created_at->translatedFormat('d F Y, H:i') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">
                            Dibayar Pada
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-900">
                            {{ $sppBill->paid_at
                                ? $sppBill->paid_at->translatedFormat('d F Y, H:i')
                                : '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-slate-500">
                            Referensi Pembayaran
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-900">
                            {{ $sppBill->payment_reference ?: '-' }}
                        </p>
                    </div>
                </div>

                @if ($sppBill->notes)
                    <div class="border-t border-slate-200 px-6 py-5">
                        <p class="text-sm font-medium text-slate-700">
                            Catatan
                        </p>

                        <p class="mt-2 whitespace-pre-line text-sm leading-6 text-slate-600">
                            {{ $sppBill->notes }}
                        </p>
                    </div>
                @endif
            </section>

            @if ($sppBill->status === 'unpaid')
                <section class="border border-amber-200 bg-amber-50 px-5 py-4">
                    <div class="flex gap-3">
                        <div class="mt-0.5 shrink-0 text-amber-600">
                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path d="M10.3 3.2 2.8 17a2 2 0 0 0 1.7 3h15a2 2 0 0 0 1.7-3L13.7 3.2a2 2 0 0 0-3.4 0Z"/>
                                <path d="M12 9v4"/>
                                <path d="M12 17h.01"/>
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-amber-800">
                                Tagihan belum dibayar
                            </p>

                            <p class="mt-1 text-sm text-amber-700">
                                Silakan lakukan pembayaran sesuai prosedur yang ditentukan oleh pihak bimbel.
                            </p>
                        </div>
                    </div>
                </section>
            @elseif ($sppBill->status === 'paid')
                <section class="border border-emerald-200 bg-emerald-50 px-5 py-4">
                    <div class="flex gap-3">
                        <div class="mt-0.5 shrink-0 text-emerald-600">
                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path d="m9 12 2 2 4-4"/>
                                <circle cx="12" cy="12" r="9"/>
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-emerald-800">
                                Pembayaran berhasil
                            </p>

                            <p class="mt-1 text-sm text-emerald-700">
                                Tagihan SPP untuk periode {{ $sppBill->period }} telah tercatat sebagai lunas.
                            </p>
                        </div>
                    </div>
                </section>
            @elseif ($sppBill->status === 'pending')
                <section class="border border-blue-200 bg-blue-50 px-5 py-4">
                    <div class="flex gap-3">
                        <div class="mt-0.5 shrink-0 text-blue-600">
                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <circle cx="12" cy="12" r="9"/>
                                <path d="M12 7v5l3 2"/>
                            </svg>
                        </div>

                        <div>
                            <p class="text-sm font-medium text-blue-800">
                                Pembayaran sedang diproses
                            </p>

                            <p class="mt-1 text-sm text-blue-700">
                                Status pembayaran untuk tagihan ini masih menunggu konfirmasi.
                            </p>
                        </div>
                    </div>
                </section>
            @endif
        </div>
    </main>
</body>
</html>
