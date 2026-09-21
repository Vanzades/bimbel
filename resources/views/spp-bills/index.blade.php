<x-admin-layout>
    <x-slot name="title">SPP</x-slot>

    <div class="space-y-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <div class="flex items-center gap-2 text-sm text-slate-500">
                    <a href="{{ route('dashboard') }}" class="transition hover:text-slate-900">
                        Dashboard
                    </a>
                    <span>/</span>
                    <span class="text-slate-900">SPP</span>
                </div>

                <h1 class="mt-2 text-2xl font-semibold tracking-tight text-slate-950">
                    Tagihan SPP
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Kelola tagihan dan riwayat pembayaran SPP siswa.
                </p>
            </div>

            <a
                href="{{ route('spp-bills.create') }}"
                class="inline-flex h-10 items-center justify-center rounded-md bg-slate-950 px-4 text-sm font-medium text-white transition hover:bg-slate-800"
            >
                + Tambah Tagihan
            </a>
        </div>

        @if ($errors->any())
            <div class="rounded-md border border-red-200 bg-red-50 px-4 py-3">
                <div class="text-sm font-medium text-red-800">
                    Terdapat kesalahan pada data.
                </div>

                <ul class="mt-1 list-disc space-y-1 pl-5 text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="rounded-lg border border-slate-200 bg-white shadow-sm">
            <form
                method="GET"
                action="{{ route('spp-bills.index') }}"
                class="border-b border-slate-200 p-4"
            >
                <div class="grid gap-3 md:grid-cols-2 lg:grid-cols-5">
                    <div class="lg:col-span-2">
                        <label
                            for="search"
                            class="mb-1.5 block text-xs font-medium text-slate-600"
                        >
                            Cari Siswa
                        </label>

                        <input
                            id="search"
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Nama atau NIS/NISN..."
                            class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                        >
                    </div>

                    <div>
                        <label
                            for="class_room_id"
                            class="mb-1.5 block text-xs font-medium text-slate-600"
                        >
                            Kelas
                        </label>

                        <select
                            id="class_room_id"
                            name="class_room_id"
                            class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                        >
                            <option value="">Semua Kelas</option>

                            @foreach ($classRooms as $classRoom)
                                <option
                                    value="{{ $classRoom->id }}"
                                    @selected(request('class_room_id') == $classRoom->id)
                                >
                                    {{ $classRoom->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label
                            for="status"
                            class="mb-1.5 block text-xs font-medium text-slate-600"
                        >
                            Status
                        </label>

                        <select
                            id="status"
                            name="status"
                            class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
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
                            for="month"
                            class="mb-1.5 block text-xs font-medium text-slate-600"
                        >
                            Bulan
                        </label>

                        <select
                            id="month"
                            name="month"
                            class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                        >
                            <option value="">Semua Bulan</option>

                            @foreach ([
                                1 => 'Januari',
                                2 => 'Februari',
                                3 => 'Maret',
                                4 => 'April',
                                5 => 'Mei',
                                6 => 'Juni',
                                7 => 'Juli',
                                8 => 'Agustus',
                                9 => 'September',
                                10 => 'Oktober',
                                11 => 'November',
                                12 => 'Desember',
                            ] as $number => $monthName)
                                <option
                                    value="{{ $number }}"
                                    @selected((string) request('month') === (string) $number)
                                >
                                    {{ $monthName }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mt-3 flex flex-col gap-3 sm:flex-row sm:items-center">
                    <div>
                        <label
                            for="year"
                            class="mb-1.5 block text-xs font-medium text-slate-600"
                        >
                            Tahun
                        </label>

                        <select
                            id="year"
                            name="year"
                            class="h-10 min-w-40 rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
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

                    <div class="flex items-end gap-2 sm:ml-auto">
                        <button
                            type="submit"
                            class="h-10 rounded-md bg-slate-950 px-4 text-sm font-medium text-white transition hover:bg-slate-800"
                        >
                            Terapkan Filter
                        </button>

                        @if (request()->hasAny(['search', 'class_room_id', 'status', 'month', 'year']))
                            <a
                                href="{{ route('spp-bills.index') }}"
                                class="inline-flex h-10 items-center rounded-md border border-slate-200 bg-white px-4 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
                            >
                                Reset
                            </a>
                        @endif
                    </div>
                </div>
            </form>

            <div class="overflow-x-auto">
                <table class="w-full min-w-[900px] text-left text-sm">
                    <thead class="border-b border-slate-200 bg-slate-50/70">
                        <tr>
                            <th class="px-6 py-3.5 font-medium text-slate-500">
                                Siswa
                            </th>

                            <th class="px-6 py-3.5 font-medium text-slate-500">
                                Kelas
                            </th>

                            <th class="px-6 py-3.5 font-medium text-slate-500">
                                Periode
                            </th>

                            <th class="px-6 py-3.5 font-medium text-slate-500">
                                Nominal
                            </th>

                            <th class="px-6 py-3.5 font-medium text-slate-500">
                                Status
                            </th>

                            <th class="px-6 py-3.5 text-right font-medium text-slate-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-100">
                        @forelse ($sppBills as $sppBill)
                            @php
                                $statusStyles = [
                                    'paid' => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
                                    'unpaid' => 'bg-amber-50 text-amber-700 ring-amber-600/20',
                                    'pending' => 'bg-blue-50 text-blue-700 ring-blue-600/20',
                                    'failed' => 'bg-red-50 text-red-700 ring-red-600/20',
                                    'expired' => 'bg-slate-100 text-slate-600 ring-slate-500/20',
                                ];

                                $statusLabels = [
                                    'paid' => 'Lunas',
                                    'unpaid' => 'Belum Lunas',
                                    'pending' => 'Menunggu',
                                    'failed' => 'Gagal',
                                    'expired' => 'Expired',
                                ];
                            @endphp

                            <tr class="transition hover:bg-slate-50/70">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-slate-900">
                                        {{ $sppBill->student->name }}
                                    </div>

                                    <div class="mt-0.5 text-xs text-slate-500">
                                        {{ $sppBill->student->identity_number }}
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-slate-600">
                                    {{ $sppBill->student->classRoom->name ?? '-' }}
                                </td>

                                <td class="px-6 py-4 font-medium text-slate-700">
                                    {{ $sppBill->period }}
                                </td>

                                <td class="px-6 py-4 font-medium text-slate-900">
                                    Rp {{ number_format($sppBill->amount, 0, ',', '.') }}
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-medium ring-1 ring-inset {{ $statusStyles[$sppBill->status] ?? 'bg-slate-100 text-slate-600 ring-slate-500/20' }}"
                                    >
                                        {{ $statusLabels[$sppBill->status] ?? ucfirst($sppBill->status) }}
                                    </span>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-end gap-1">
                                        <a
                                            href="{{ route('spp-bills.show', $sppBill) }}"
                                            class="rounded-md px-2.5 py-1.5 text-xs font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"
                                        >
                                            Detail
                                        </a>

                                        <a
                                            href="{{ route('spp-bills.edit', $sppBill) }}"
                                            class="rounded-md px-2.5 py-1.5 text-xs font-medium text-slate-600 transition hover:bg-slate-100 hover:text-slate-900"
                                        >
                                            Edit
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('spp-bills.destroy', $sppBill) }}"
                                            onsubmit="return confirm('Hapus tagihan SPP ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="rounded-md px-2.5 py-1.5 text-xs font-medium text-red-600 transition hover:bg-red-50"
                                            >
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="text-sm font-medium text-slate-900">
                                        Belum ada tagihan SPP
                                    </div>

                                    <p class="mt-1 text-sm text-slate-500">
                                        Tambahkan tagihan SPP untuk mulai mengelola pembayaran siswa.
                                    </p>

                                    <a
                                        href="{{ route('spp-bills.create') }}"
                                        class="mt-4 inline-flex h-9 items-center rounded-md bg-slate-950 px-3.5 text-sm font-medium text-white transition hover:bg-slate-800"
                                    >
                                        Tambah Tagihan
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($sppBills->hasPages())
                <div class="border-t border-slate-200 px-6 py-4">
                    {{ $sppBills->links() }}
                </div>
            @endif
        </div>
    </div>
</x-admin-layout>
