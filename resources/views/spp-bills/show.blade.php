<x-admin-layout title="Detail Tagihan SPP">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                <a href="{{ route('spp-bills.index') }}" class="transition hover:text-slate-950">
                    SPP
                </a>
                <span>/</span>
                <span class="text-slate-900">Detail</span>
            </div>

            <h1 class="text-2xl font-semibold tracking-tight text-slate-950">
                Detail Tagihan SPP
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Informasi lengkap tagihan SPP siswa.
            </p>
        </div>

        <div class="flex flex-wrap items-center gap-2">
            <a
                href="{{ route('spp-bills.index') }}"
                class="inline-flex h-10 items-center justify-center rounded-md border border-slate-200 bg-white px-4 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50"
            >
                Kembali
            </a>

            <a
                href="{{ route('spp-bills.edit', $sppBill) }}"
                class="inline-flex h-10 items-center justify-center rounded-md bg-slate-950 px-4 text-sm font-medium text-white shadow-sm transition hover:bg-slate-800"
            >
                Edit Tagihan
            </a>
        </div>
    </div>

    @php
        $statusLabels = [
            'paid' => 'Lunas',
            'unpaid' => 'Belum Lunas',
            'pending' => 'Menunggu Pembayaran',
            'failed' => 'Gagal',
            'expired' => 'Expired',
        ];

        $statusClasses = [
            'paid' => 'border-emerald-200 bg-emerald-50 text-emerald-700',
            'unpaid' => 'border-amber-200 bg-amber-50 text-amber-700',
            'pending' => 'border-blue-200 bg-blue-50 text-blue-700',
            'failed' => 'border-red-200 bg-red-50 text-red-700',
            'expired' => 'border-slate-200 bg-slate-100 text-slate-600',
        ];
    @endphp

    <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_320px]">
        <div class="space-y-6">
            <div class="rounded-lg border border-slate-200 bg-white shadow-sm">
                <div class="flex flex-col gap-4 border-b border-slate-200 px-6 py-5 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-base font-semibold text-slate-950">
                            Informasi Tagihan
                        </h2>

                        <p class="mt-1 text-sm text-slate-500">
                            {{ $sppBill->period }}
                        </p>
                    </div>

                    <span
                        class="inline-flex w-fit items-center rounded-full border px-3 py-1 text-xs font-medium {{ $statusClasses[$sppBill->status] ?? 'border-slate-200 bg-slate-100 text-slate-600' }}"
                    >
                        {{ $statusLabels[$sppBill->status] ?? ucfirst($sppBill->status) }}
                    </span>
                </div>

                <div class="grid gap-x-8 gap-y-6 p-6 sm:grid-cols-2">
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Siswa
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-950">
                            {{ $sppBill->student->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            NIS / Identitas
                        </p>

                        <p class="mt-1 text-sm text-slate-700">
                            {{ $sppBill->student->identity_number }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Kelas
                        </p>

                        <p class="mt-1 text-sm text-slate-700">
                            {{ $sppBill->student->classRoom?->name ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Periode
                        </p>

                        <p class="mt-1 text-sm text-slate-700">
                            {{ $sppBill->period }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Nominal
                        </p>

                        <p class="mt-1 text-lg font-semibold text-slate-950">
                            Rp {{ number_format($sppBill->amount, 0, ',', '.') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Status
                        </p>

                        <p class="mt-1 text-sm text-slate-700">
                            {{ $statusLabels[$sppBill->status] ?? ucfirst($sppBill->status) }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Tanggal Pembayaran
                        </p>

                        <p class="mt-1 text-sm text-slate-700">
                            {{ $sppBill->paid_at?->format('d M Y, H:i') ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Referensi Pembayaran
                        </p>

                        <p class="mt-1 break-all text-sm text-slate-700">
                            {{ $sppBill->payment_reference ?: '-' }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="rounded-lg border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-5">
                    <h2 class="text-base font-semibold text-slate-950">
                        Catatan
                    </h2>
                </div>

                <div class="p-6">
                    @if ($sppBill->notes)
                        <p class="whitespace-pre-line text-sm leading-6 text-slate-700">
                            {{ $sppBill->notes }}
                        </p>
                    @else
                        <p class="text-sm text-slate-500">
                            Tidak ada catatan untuk tagihan ini.
                        </p>
                    @endif
                </div>
            </div>

            <div class="rounded-lg border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-5">
                    <h2 class="text-base font-semibold text-slate-950">
                        Informasi Sistem
                    </h2>
                </div>

                <div class="grid gap-x-8 gap-y-5 p-6 sm:grid-cols-2">
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            ID Tagihan
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-900">
                            #{{ $sppBill->id }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Dibuat
                        </p>

                        <p class="mt-1 text-sm text-slate-700">
                            {{ $sppBill->created_at?->format('d M Y, H:i') ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Terakhir Diperbarui
                        </p>

                        <p class="mt-1 text-sm text-slate-700">
                            {{ $sppBill->updated_at?->format('d M Y, H:i') ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Siswa Aktif
                        </p>

                        <p class="mt-1 text-sm text-slate-700">
                            {{ $sppBill->student->status === 'active' ? 'Ya' : 'Tidak' }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="rounded-lg border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-5 py-4">
                    <h2 class="text-sm font-semibold text-slate-950">
                        Ringkasan
                    </h2>
                </div>

                <div class="space-y-5 p-5">
                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Siswa
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-900">
                            {{ $sppBill->student->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Kelas
                        </p>

                        <p class="mt-1 text-sm text-slate-700">
                            {{ $sppBill->student->classRoom?->name ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Periode
                        </p>

                        <p class="mt-1 text-sm text-slate-700">
                            {{ $sppBill->period }}
                        </p>
                    </div>

                    <div class="border-t border-slate-100 pt-5">
                        <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                            Total Tagihan
                        </p>

                        <p class="mt-1 text-xl font-semibold tracking-tight text-slate-950">
                            Rp {{ number_format($sppBill->amount, 0, ',', '.') }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="rounded-lg border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-5 py-4">
                    <h2 class="text-sm font-semibold text-slate-950">
                        Aksi
                    </h2>
                </div>

                <div class="space-y-2 p-5">
                    <a
                        href="{{ route('spp-bills.edit', $sppBill) }}"
                        class="flex h-10 w-full items-center justify-center rounded-md bg-slate-950 px-4 text-sm font-medium text-white transition hover:bg-slate-800"
                    >
                        Edit Tagihan
                    </a>

                    <form
                        action="{{ route('spp-bills.destroy', $sppBill) }}"
                        method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus tagihan SPP ini?')"
                    >
                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="flex h-10 w-full items-center justify-center rounded-md border border-red-200 bg-white px-4 text-sm font-medium text-red-600 transition hover:bg-red-50"
                        >
                            Hapus Tagihan
                        </button>
                    </form>
                </div>
            </div>

            @if ($sppBill->status === 'paid')
                <div class="rounded-lg border border-emerald-200 bg-emerald-50 p-5">
                    <p class="text-sm font-medium text-emerald-900">
                        Pembayaran Lunas
                    </p>

                    <p class="mt-1 text-sm leading-5 text-emerald-700">
                        Tagihan ini telah tercatat sebagai lunas
                        @if ($sppBill->paid_at)
                            pada {{ $sppBill->paid_at->format('d M Y, H:i') }}.
                        @else
                            .
                        @endif
                    </p>
                </div>
            @elseif ($sppBill->status === 'unpaid')
                <div class="rounded-lg border border-amber-200 bg-amber-50 p-5">
                    <p class="text-sm font-medium text-amber-900">
                        Belum Lunas
                    </p>

                    <p class="mt-1 text-sm leading-5 text-amber-800">
                        Tagihan ini masih memiliki status belum lunas.
                    </p>
                </div>
            @elseif ($sppBill->status === 'pending')
                <div class="rounded-lg border border-blue-200 bg-blue-50 p-5">
                    <p class="text-sm font-medium text-blue-900">
                        Menunggu Pembayaran
                    </p>

                    <p class="mt-1 text-sm leading-5 text-blue-800">
                        Pembayaran tagihan masih menunggu proses.
                    </p>
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
