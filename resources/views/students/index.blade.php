<x-admin-layout>
    <x-slot name="title">
        Siswa
    </x-slot>

    <div class="space-y-6">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-slate-950">
                    Siswa
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Kelola data siswa yang terdaftar dalam sistem.
                </p>
            </div>

            <a
                href="{{ route('students.create') }}"
                class="inline-flex h-9 items-center justify-center rounded-md bg-slate-950 px-4 text-sm font-medium text-white transition hover:bg-slate-800"
            >
                Tambah Siswa
            </a>
        </div>

        <div class="rounded-lg border border-slate-200 bg-white">

            <div class="border-b border-slate-200 p-5">
                <form
                    method="GET"
                    action="{{ route('students.index') }}"
                    class="grid gap-3 xl:grid-cols-[1fr_180px_180px_180px_auto]"
                >
                    <div class="relative">
                        <svg
                            class="pointer-events-none absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <circle cx="11" cy="11" r="8"/>
                            <path d="m21 21-4.3-4.3"/>
                        </svg>

                        <input
                            type="text"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama, NIK, atau telepon..."
                            class="h-9 w-full rounded-md border border-slate-200 bg-white pl-9 pr-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                        >
                    </div>

                    <select
                        name="class_room_id"
                        class="h-9 rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                    >
                        <option value="">Semua Kelas</option>

                        @foreach ($classRooms as $classRoom)
                            <option
                                value="{{ $classRoom->id }}"
                                @selected((string) request('class_room_id') === (string) $classRoom->id)
                            >
                                {{ $classRoom->name }}
                            </option>
                        @endforeach
                    </select>

                    <select
                        name="gender"
                        class="h-9 rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                    >
                        <option value="">Semua Gender</option>

                        <option
                            value="male"
                            @selected(request('gender') === 'male')
                        >
                            Laki-laki
                        </option>

                        <option
                            value="female"
                            @selected(request('gender') === 'female')
                        >
                            Perempuan
                        </option>
                    </select>

                    <select
                        name="status"
                        class="h-9 rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                    >
                        <option value="">Semua Status</option>

                        <option
                            value="active"
                            @selected(request('status') === 'active')
                        >
                            Aktif
                        </option>

                        <option
                            value="inactive"
                            @selected(request('status') === 'inactive')
                        >
                            Nonaktif
                        </option>
                    </select>

                    <div class="flex gap-2">
                        <button
                            type="submit"
                            class="h-9 rounded-md border border-slate-200 bg-white px-4 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
                        >
                            Filter
                        </button>

                        @if (request()->filled('search') || request()->filled('class_room_id') || request()->filled('gender') || request()->filled('status'))
                            <a
                                href="{{ route('students.index') }}"
                                class="inline-flex h-9 items-center rounded-md px-3 text-sm text-slate-500 transition hover:bg-slate-100 hover:text-slate-900"
                            >
                                Reset
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="border-b border-slate-200 bg-slate-50">
                        <tr>
                            <th class="whitespace-nowrap px-5 py-3 text-xs font-medium text-slate-500">
                                Siswa
                            </th>

                            <th class="whitespace-nowrap px-5 py-3 text-xs font-medium text-slate-500">
                                NIK
                            </th>

                            <th class="whitespace-nowrap px-5 py-3 text-xs font-medium text-slate-500">
                                Kelas
                            </th>

                            <th class="whitespace-nowrap px-5 py-3 text-xs font-medium text-slate-500">
                                Gender
                            </th>

                            <th class="whitespace-nowrap px-5 py-3 text-xs font-medium text-slate-500">
                                Kontak
                            </th>

                            <th class="whitespace-nowrap px-5 py-3 text-xs font-medium text-slate-500">
                                Status
                            </th>

                            <th class="whitespace-nowrap px-5 py-3 text-right text-xs font-medium text-slate-500">
                                Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-slate-200">
                        @forelse ($students as $student)
                            <tr class="transition hover:bg-slate-50">

                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-100 text-xs font-semibold uppercase text-slate-700">
                                            {{ substr($student->name, 0, 1) }}
                                        </div>

                                        <div class="min-w-0">
                                            <div class="truncate text-sm font-medium text-slate-900">
                                                {{ $student->name }}
                                            </div>

                                            <div class="mt-0.5 text-xs text-slate-500">
                                                {{ $student->address ? 'Data lengkap tersedia' : 'Alamat belum tersedia' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <span class="text-sm text-slate-600">
                                        {{ $student->identity_number }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
                                    @if ($student->classRoom)
                                        <span class="inline-flex rounded-md bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-700">
                                            {{ $student->classRoom->name }}
                                        </span>
                                    @else
                                        <span class="text-sm text-slate-400">
                                            —
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    <span class="text-sm text-slate-600">
                                        {{ $student->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
                                    <span class="text-sm text-slate-600">
                                        {{ $student->phone ?: '—' }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
                                    @if ($student->status === 'active')
                                        <span class="inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-[11px] font-medium text-emerald-700">
                                            Aktif
                                        </span>
                                    @else
                                        <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-[11px] font-medium text-slate-500">
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    <div class="flex items-center justify-end gap-1">

                                        <a
                                            href="{{ route('students.show', $student) }}"
                                            title="Detail"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-md text-slate-500 transition hover:bg-slate-100 hover:text-slate-900"
                                        >
                                            <svg
                                                class="h-4 w-4"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <circle cx="12" cy="12" r="10"/>
                                                <path d="M12 16v-4"/>
                                                <path d="M12 8h.01"/>
                                            </svg>
                                        </a>

                                        <a
                                            href="{{ route('students.edit', $student) }}"
                                            title="Edit"
                                            class="inline-flex h-8 w-8 items-center justify-center rounded-md text-slate-500 transition hover:bg-slate-100 hover:text-slate-900"
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
                                        </a>

                                        <form
                                            method="POST"
                                            action="{{ route('students.destroy', $student) }}"
                                            onsubmit="return confirm('Yakin ingin menghapus data siswa ini?')"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Hapus"
                                                class="inline-flex h-8 w-8 items-center justify-center rounded-md text-slate-500 transition hover:bg-red-50 hover:text-red-600"
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
                                            </button>
                                        </form>

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td
                                    colspan="7"
                                    class="px-5 py-12 text-center"
                                >
                                    <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-full bg-slate-100 text-slate-400">
                                        <svg
                                            class="h-5 w-5"
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

                                    <p class="mt-3 text-sm font-medium text-slate-900">
                                        Belum ada data siswa
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Tambahkan data siswa untuk mulai mengelola peserta bimbingan.
                                    </p>

                                    <a
                                        href="{{ route('students.create') }}"
                                        class="mt-4 inline-flex h-9 items-center rounded-md bg-slate-950 px-4 text-sm font-medium text-white transition hover:bg-slate-800"
                                    >
                                        Tambah Siswa
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($students->hasPages())
                <div class="border-t border-slate-200 px-5 py-4">
                    {{ $students->links() }}
                </div>
            @endif

        </div>

    </div>
</x-admin-layout>
