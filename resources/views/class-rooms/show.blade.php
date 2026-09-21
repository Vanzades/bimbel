<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Detail Kelas
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Informasi kelas dan daftar siswa
                </p>
            </div>

            <div class="flex items-center gap-2">
                <a
                    href="{{ route('class-rooms.edit', $classRoom) }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 rounded-lg text-sm font-medium text-white hover:bg-indigo-700">
                    Edit
                </a>

                <a
                    href="{{ route('class-rooms.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-200">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                    <p class="text-sm text-gray-500">Nama Kelas</p>
                    <p class="mt-2 text-lg font-semibold text-gray-900">
                        {{ $classRoom->name }}
                    </p>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                    <p class="text-sm text-gray-500">Kode Kelas</p>
                    <p class="mt-2 text-lg font-semibold text-gray-900">
                        {{ $classRoom->code }}
                    </p>
                </div>

                <div class="bg-white border border-gray-200 rounded-xl p-5 shadow-sm">
                    <p class="text-sm text-gray-500">Status</p>
                    <div class="mt-2">
                        @if ($classRoom->status === 'active')
                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                            Aktif
                        </span>
                        @else
                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                            Tidak Aktif
                        </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm p-6">
                <div class="mb-5">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Deskripsi
                    </h3>

                    <p class="mt-2 text-sm text-gray-600">
                        {{ $classRoom->description ?: 'Tidak ada deskripsi.' }}
                    </p>
                </div>
            </div>

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                Daftar Siswa
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                {{ $classRoom->students->count() }} siswa terdaftar di kelas ini
                            </p>
                        </div>
                    </div>
                </div>

                @if ($classRoom->students->count())
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600">
                                    No
                                </th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600">
                                    Nama
                                </th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600">
                                    NIS/NISN
                                </th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600">
                                    Jenis Kelamin
                                </th>
                                <th class="px-6 py-3 text-left font-semibold text-gray-600">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-right font-semibold text-gray-600">
                                    Aksi
                                </th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-200">
                            @foreach ($classRoom->students as $index => $student)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 text-gray-500">
                                    {{ $index + 1 }}
                                </td>

                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $student->name }}
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    {{ $student->identity_number }}
                                </td>

                                <td class="px-6 py-4 text-gray-600">
                                    {{ $student->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}
                                </td>

                                <td class="px-6 py-4">
                                    @if ($student->status === 'active')
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                        Aktif
                                    </span>
                                    @else
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                        Tidak Aktif
                                    </span>
                                    @endif
                                </td>

                                <td class="px-6 py-4 text-right">
                                    <a
                                        href="{{ route('students.show', $student) }}"
                                        class="text-indigo-600 hover:text-indigo-800 font-medium">
                                        Detail
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="px-6 py-12 text-center">
                    <p class="text-sm text-gray-500">
                        Belum ada siswa yang terdaftar di kelas ini.
                    </p>

                    <a
                        href="{{ route('students.create') }}"
                        class="inline-flex mt-4 px-4 py-2 bg-indigo-600 rounded-lg text-sm font-medium text-white hover:bg-indigo-700">
                        Tambah Siswa
                    </a>
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>