<x-admin-layout>
    <x-slot name="title">
        Detail Guru
    </x-slot>

    <div class="space-y-6">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-3">
                <a
                    href="{{ route('admin.teachers.index') }}"
                    class="inline-flex h-9 w-9 items-center justify-center rounded-md border border-slate-200 bg-white text-slate-500 transition hover:bg-slate-50 hover:text-slate-900"
                >
                    <svg
                        class="h-4 w-4"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path d="m15 18-6-6 6-6"/>
                    </svg>
                </a>

                <div>
                    <h1 class="text-2xl font-semibold tracking-tight text-slate-950">
                        Detail Guru
                    </h1>

                    <p class="mt-1 text-sm text-slate-500">
                        Informasi lengkap guru yang terdaftar.
                    </p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a
                    href="{{ route('admin.teachers.edit', $teacher) }}"
                    class="inline-flex h-9 items-center justify-center gap-2 rounded-md border border-slate-200 bg-white px-4 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
                >
                    <svg
                        class="h-4 w-4"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path d="M12 20h9"/>
                        <path d="M16.5 3.5a2.12 2.12 0 0 1 3 3L8 18l-4 1 1-4Z"/>
                    </svg>

                    Edit
                </a>

                <form
                    method="POST"
                    action="{{ route('admin.teachers.destroy', $teacher) }}"
                    onsubmit="return confirm('Yakin ingin menghapus data guru ini?')"
                >
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="inline-flex h-9 items-center justify-center gap-2 rounded-md bg-red-600 px-4 text-sm font-medium text-white transition hover:bg-red-700"
                    >
                        <svg
                            class="h-4 w-4"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path d="M3 6h18"/>
                            <path d="M8 6V4h8v2"/>
                            <path d="M19 6l-1 14H6L5 6"/>
                            <path d="M10 11v5"/>
                            <path d="M14 11v5"/>
                        </svg>

                        Hapus
                    </button>
                </form>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">

            <div class="rounded-lg border border-slate-200 bg-white lg:col-span-1">
                <div class="flex flex-col items-center px-6 py-8 text-center">

                    <div class="flex h-20 w-20 items-center justify-center rounded-full bg-slate-100 text-2xl font-semibold uppercase text-slate-700">
                        {{ substr($teacher->name, 0, 1) }}
                    </div>

                    <h2 class="mt-4 text-lg font-semibold text-slate-950">
                        {{ $teacher->name }}
                    </h2>

                    <p class="mt-1 text-sm text-slate-500">
                        {{ $teacher->identity_number }}
                    </p>

                    <div class="mt-4">
                        @if ($teacher->status === 'active')
                            <span class="inline-flex rounded-full bg-emerald-50 px-3 py-1 text-xs font-medium text-emerald-700">
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-500">
                                Nonaktif
                            </span>
                        @endif
                    </div>

                    @if ($teacher->user)
                        <div class="mt-6 w-full rounded-md border border-slate-200 bg-slate-50 p-4 text-left">
                            <p class="text-xs font-medium uppercase tracking-wide text-slate-400">
                                Akun Login
                            </p>

                            <p class="mt-1 text-sm font-medium text-slate-900">
                                {{ $teacher->user->email }}
                            </p>

                            <a
                                href="{{ route('admin.users.show', $teacher->user) }}"
                                class="mt-3 inline-flex text-xs font-medium text-slate-600 hover:text-slate-950"
                            >
                                Lihat akun →
                            </a>
                        </div>
                    @else
                        <div class="mt-6 w-full rounded-md border border-amber-200 bg-amber-50 p-4 text-left">
                            <p class="text-xs font-medium text-amber-700">
                                Belum memiliki akun login.
                            </p>

                            <a
                                href="{{ route('admin.users.create') }}"
                                class="mt-2 inline-flex text-xs font-medium text-amber-800 hover:underline"
                            >
                                Buat akun →
                            </a>
                        </div>
                    @endif

                </div>
            </div>

            <div class="rounded-lg border border-slate-200 bg-white lg:col-span-2">

                <div class="border-b border-slate-200 px-5 py-4">
                    <h2 class="text-sm font-semibold text-slate-950">
                        Informasi Guru
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Data pribadi dan informasi kontak.
                    </p>
                </div>

                <div class="grid gap-x-8 gap-y-6 p-5 sm:grid-cols-2">

                    <div>
                        <p class="text-xs font-medium text-slate-400">
                            Nama Lengkap
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-900">
                            {{ $teacher->name }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-slate-400">
                            NIK / Nomor Identitas
                        </p>

                        <p class="mt-1 text-sm font-medium text-slate-900">
                            {{ $teacher->identity_number }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-slate-400">
                            Jenis Kelamin
                        </p>

                        <p class="mt-1 text-sm text-slate-700">
                            {{ $teacher->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-slate-400">
                            Email
                        </p>

                        <p class="mt-1 break-all text-sm text-slate-700">
                            {{ $teacher->email ?: 'Belum tersedia' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-slate-400">
                            Nomor Telepon
                        </p>

                        <p class="mt-1 text-sm text-slate-700">
                            {{ $teacher->phone ?: 'Belum tersedia' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-xs font-medium text-slate-400">
                            Status
                        </p>

                        <div class="mt-1">
                            @if ($teacher->status === 'active')
                                <span class="inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-medium text-emerald-700">
                                    Aktif
                                </span>
                            @else
                                <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-medium text-slate-500">
                                    Nonaktif
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="sm:col-span-2">
                        <p class="text-xs font-medium text-slate-400">
                            Alamat
                        </p>

                        <p class="mt-1 whitespace-pre-line text-sm leading-6 text-slate-700">
                            {{ $teacher->address ?: 'Belum tersedia' }}
                        </p>
                    </div>

                </div>

            </div>

        </div>

        <div class="grid gap-6 sm:grid-cols-2">

            <div class="rounded-lg border border-slate-200 bg-white p-5">
                <p class="text-xs font-medium text-slate-400">
                    Data Dibuat
                </p>

                <p class="mt-1 text-sm font-medium text-slate-900">
                    {{ $teacher->created_at?->format('d F Y, H:i') }}
                </p>
            </div>

            <div class="rounded-lg border border-slate-200 bg-white p-5">
                <p class="text-xs font-medium text-slate-400">
                    Terakhir Diperbarui
                </p>

                <p class="mt-1 text-sm font-medium text-slate-900">
                    {{ $teacher->updated_at?->format('d F Y, H:i') }}
                </p>
            </div>

        </div>

    </div>
</x-admin-layout>
