<x-admin-layout title="Edit Tagihan SPP">
    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="mb-2 flex items-center gap-2 text-sm text-slate-500">
                <a href="{{ route('admin.spp-bills.index') }}" class="transition hover:text-slate-950">
                    SPP
                </a>
                <span>/</span>
                <span class="text-slate-500">Edit</span>
                <span>/</span>
                <span class="text-slate-900">{{ $sppBill->student->name }}</span>
            </div>

            <h1 class="text-2xl font-semibold tracking-tight text-slate-950">
                Edit Tagihan SPP
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Perbarui informasi tagihan SPP siswa.
            </p>
        </div>

        <a
            href="{{ route('admin.spp-bills.show', $sppBill) }}"
            class="inline-flex h-10 items-center justify-center rounded-md border border-slate-200 bg-white px-4 text-sm font-medium text-slate-700 shadow-sm transition hover:bg-slate-50"
        >
            Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 rounded-md border border-red-200 bg-red-50 px-4 py-3">
            <div class="text-sm font-medium text-red-800">
                Terdapat kesalahan pada form.
            </div>

            <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.spp-bills.update', $sppBill) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="grid gap-6 lg:grid-cols-[minmax(0,1fr)_320px]">
            <div class="rounded-lg border border-slate-200 bg-white shadow-sm">
                <div class="border-b border-slate-200 px-6 py-5">
                    <h2 class="text-base font-semibold text-slate-950">
                        Informasi Tagihan
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        Perbarui data utama tagihan SPP.
                    </p>
                </div>

                <div class="space-y-6 p-6">
                    <div>
                        <label for="student_id" class="mb-2 block text-sm font-medium text-slate-700">
                            Siswa <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="student_id"
                            name="student_id"
                            required
                            class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                        >
                            <option value="">Pilih siswa</option>

                            @foreach ($students as $student)
                                <option
                                    value="{{ $student->id }}"
                                    @selected(old('student_id', $sppBill->student_id) == $student->id)
                                >
                                    {{ $student->name }}
                                    — {{ $student->identity_number }}
                                    @if ($student->classRoom)
                                        — {{ $student->classRoom->name }}
                                    @endif
                                </option>
                            @endforeach
                        </select>

                        @error('student_id')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <label for="amount" class="mb-2 block text-sm font-medium text-slate-700">
                                Nominal SPP <span class="text-red-500">*</span>
                            </label>

                            <div class="relative">
                                <span class="pointer-events-none absolute inset-y-0 left-3 flex items-center text-sm text-slate-500">
                                    Rp
                                </span>

                                <input
                                    type="number"
                                    id="amount"
                                    name="amount"
                                    value="{{ old('amount', $sppBill->amount) }}"
                                    min="0"
                                    step="0.01"
                                    required
                                    class="h-10 w-full rounded-md border border-slate-200 bg-white pl-10 pr-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                                >
                            </div>

                            @error('amount')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="status" class="mb-2 block text-sm font-medium text-slate-700">
                                Status <span class="text-red-500">*</span>
                            </label>

                            <select
                                id="status"
                                name="status"
                                required
                                class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                            >
                                <option value="unpaid" @selected(old('status', $sppBill->status) === 'unpaid')>
                                    Belum Lunas
                                </option>
                                <option value="pending" @selected(old('status', $sppBill->status) === 'pending')>
                                    Menunggu Pembayaran
                                </option>
                                <option value="paid" @selected(old('status', $sppBill->status) === 'paid')>
                                    Lunas
                                </option>
                                <option value="failed" @selected(old('status', $sppBill->status) === 'failed')>
                                    Gagal
                                </option>
                                <option value="expired" @selected(old('status', $sppBill->status) === 'expired')>
                                    Expired
                                </option>
                            </select>

                            @error('status')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <label for="month" class="mb-2 block text-sm font-medium text-slate-700">
                                Bulan <span class="text-red-500">*</span>
                            </label>

                            @php
                                $months = [
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
                                ];
                            @endphp

                            <select
                                id="month"
                                name="month"
                                required
                                class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                            >
                                <option value="">Pilih bulan</option>

                                @foreach ($months as $number => $name)
                                    <option
                                        value="{{ $number }}"
                                        @selected(old('month', $sppBill->month) == $number)
                                    >
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('month')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="year" class="mb-2 block text-sm font-medium text-slate-700">
                                Tahun <span class="text-red-500">*</span>
                            </label>

                            <input
                                type="number"
                                id="year"
                                name="year"
                                value="{{ old('year', $sppBill->year) }}"
                                min="2000"
                                max="2100"
                                required
                                class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                            >

                            @error('year')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid gap-6 sm:grid-cols-2">
                        <div>
                            <label for="paid_at" class="mb-2 block text-sm font-medium text-slate-700">
                                Tanggal Pembayaran
                            </label>

                            <input
                                type="datetime-local"
                                id="paid_at"
                                name="paid_at"
                                value="{{ old('paid_at', $sppBill->paid_at?->format('Y-m-d\TH:i')) }}"
                                class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                            >

                            <p class="mt-1.5 text-xs text-slate-500">
                                Isi jika tagihan sudah dibayar.
                            </p>

                            @error('paid_at')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="payment_reference" class="mb-2 block text-sm font-medium text-slate-700">
                                Referensi Pembayaran
                            </label>

                            <input
                                type="text"
                                id="payment_reference"
                                name="payment_reference"
                                value="{{ old('payment_reference', $sppBill->payment_reference) }}"
                                placeholder="Contoh: PAY-2026-0001"
                                class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                            >

                            <p class="mt-1.5 text-xs text-slate-500">
                                Nomor transaksi atau referensi pembayaran.
                            </p>

                            @error('payment_reference')
                                <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="notes" class="mb-2 block text-sm font-medium text-slate-700">
                            Catatan
                        </label>

                        <textarea
                            id="notes"
                            name="notes"
                            rows="4"
                            placeholder="Tambahkan catatan jika diperlukan..."
                            class="w-full resize-none rounded-md border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-200"
                        >{{ old('notes', $sppBill->notes) }}</textarea>

                        @error('notes')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 px-6 py-4 sm:flex-row sm:items-center sm:justify-end">
                    <a
                        href="{{ route('admin.spp-bills.show', $sppBill) }}"
                        class="inline-flex h-10 items-center justify-center rounded-md border border-slate-200 bg-white px-4 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
                    >
                        Batal
                    </a>

                    <button
                        type="submit"
                        class="inline-flex h-10 items-center justify-center rounded-md bg-slate-950 px-4 text-sm font-medium text-white shadow-sm transition hover:bg-slate-800"
                    >
                        Simpan Perubahan
                    </button>
                </div>
            </div>

            <div class="space-y-6">
                <div class="rounded-lg border border-slate-200 bg-white shadow-sm">
                    <div class="border-b border-slate-200 px-5 py-4">
                        <h2 class="text-sm font-semibold text-slate-950">
                            Ringkasan Tagihan
                        </h2>
                    </div>

                    <div class="space-y-4 p-5">
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

                        <div>
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                                Dibuat
                            </p>
                            <p class="mt-1 text-sm text-slate-700">
                                {{ $sppBill->created_at?->format('d M Y, H:i') }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="rounded-lg border border-amber-200 bg-amber-50 p-5">
                    <p class="text-sm font-medium text-amber-900">
                        Perhatian
                    </p>

                    <p class="mt-1 text-sm leading-5 text-amber-800">
                        Perubahan siswa, bulan, atau tahun akan tetap divalidasi agar tidak terjadi duplikasi tagihan pada periode yang sama.
                    </p>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
