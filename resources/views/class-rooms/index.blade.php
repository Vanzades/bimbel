<x-admin-layout>
    <x-slot name="title">
        Kelas
    </x-slot>

    <div class="space-y-6">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-slate-950">
                    Kelas
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Kelola data kelas yang digunakan dalam kegiatan bimbingan belajar.
                </p>
            </div>

            <a
                href="{{ route('class-rooms.create') }}"
                class="inline-flex h-9 items-center justify-center rounded-md bg-slate-950 px-4 text-sm font-medium text-white transition hover:bg-slate-800"
            >
                Tambah Kelas
            </a>
        </div>

        <div class="rounded-lg border border-slate-200 bg-white">

            <div class="border-b border-slate-200 p-5">
                <form
                    method="GET"
                    action="{{ route('class-rooms.index') }}"
                    class="flex flex-col gap-3 sm:flex-row"
                >
                    <div class="relative flex-1">
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
                            placeholder="Cari nama atau kode kelas..."
                            class="h-9 w-full rounded-md border border-slate-200 bg-white pl-9 pr-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                        >
                    </div>

                    <select
                        name="status"
                        class="h-9 rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-100 sm:w-44"
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

                        @if (request()->filled('search') || request()->filled('status'))
                            <a
                                href="{{ route('class-rooms.index') }}"
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
                                Kelas
                            </th>

                            <th class="whitespace-nowrap px-5 py-3 text-xs font-medium text-slate-500">
                                Kode
                            </th>

                            <th class="whitespace-nowrap px-5 py-3 text-xs font-medium text-slate-500">
                                Siswa
                            </th>

                            <th class="whitespace-nowrap px-5 py-3 text-xs font-medium text-slate-500">
                                Deskripsi
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
                        @forelse ($classRooms as $classRoom)
                            <tr class="transition hover:bg-slate-50">

                                <td class="px-5 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-md bg-slate-100 text-slate-700">
                                            <svg
                                                class="h-4 w-4"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <path d="M3 21h18"/>
                                                <path d="M5 21V5l7-2v18"/>
                                                <path d="M19 21V9l-7-2"/>
                                                <path d="M9 9h.01"/>
                                                <path d="M9 13h.01"/>
                                                <path d="M9 17h.01"/>
                                                <path d="M15 13h.01"/>
                                                <path d="M15 17h.01"/>
                                            </svg>
                                        </div>

                                        <div class="min-w-0">
                                            <div class="text-sm font-medium text-slate-900">
                                                {{ $classRoom->name }}
                                            </div>

                                            <div class="mt-0.5 text-xs text-slate-500">
                                                Dibuat {{ $classRoom->created_at?->format('d M Y') ?? '—' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-5 py-4">
                                    <span class="inline-flex rounded-md bg-slate-100 px-2.5 py-1 text-xs font-medium text-slate-700">
                                        {{ $classRoom->code }}
                                    </span>
                                </td>

                                <td class="px-5 py-4">
                                    <span class="text-sm font-medium text-slate-700">
                                        {{ $classRoom->students_count ?? $classRoom->students->count() }}
                                    </span>

                                    <span class="ml-1 text-xs text-slate-400">
                                        siswa
                                    </span>
                                </td>

                                <td class="max-w-xs px-5 py-4">
                                    @if ($classRoom->description)
                                        <p class="truncate text-sm text-slate-600">
                                            {{ $classRoom->description }}
                                        </p>
                                    @else
                                        <span class="text-sm text-slate-400">
                                            —
                                        </span>
                                    @endif
                                </td>

                                <td class="px-5 py-4">
                                    @if ($classRoom->status === 'active')
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
                                            href="{{ route('class-rooms.show', $classRoom) }}"
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
                                            href="{{ route('class-rooms.edit', $classRoom) }}"
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

                                        @if (($classRoom->students_count ?? $classRoom->students->count()) === 0)
                                            <form
                                                method="POST"
                                                action="{{ route('class-rooms.destroy', $classRoom) }}"
                                                onsubmit="return confirm('Yakin ingin menghapus kelas ini?')"
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
                                        @else
                                            <button
                                                type="button"
                                                title="Tidak dapat dihapus karena masih memiliki siswa"
                                                class="inline-flex h-8 w-8 cursor-not-allowed items-center justify-center rounded-md text-slate-300"
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
                                        @endif

                                    </div>
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td
                                    colspan="6"
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
                                            <path d="M3 21h18"/>
                                            <path d="M5 21V5l7-2v18"/>
                                            <path d="M19 21V9l-7-2"/>
                                        </svg>
                                    </div>

                                    <p class="mt-3 text-sm font-medium text-slate-900">
                                        Belum ada data kelas
                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Tambahkan kelas untuk mulai mengelola data bimbingan.
                                    </p>

                                    <a
                                        href="{{ route('class-rooms.create') }}"
                                        class="mt-4 inline-flex h-9 items-center rounded-md bg-slate-950 px-4 text-sm font-medium text-white transition hover:bg-slate-800"
                                    >
                                        Tambah Kelas
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($classRooms->hasPages())
                <div class="border-t border-slate-200 px-5 py-4">
                    {{ $classRooms->links() }}
                </div>
            @endif

        </div>

    </div>
</x-admin-layout>
