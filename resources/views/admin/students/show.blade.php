<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Detail Siswa
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Informasi lengkap data siswa
                </p>
            </div>

            <div class="flex items-center gap-2">
                <a
                    href="{{ route('admin.students.edit', $student) }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 rounded-lg text-sm font-medium text-white hover:bg-indigo-700">
                    Edit
                </a>

                <a
                    href="{{ route('admin.students.index') }}"
                    class="inline-flex items-center px-4 py-2 bg-gray-100 border border-gray-200 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-200">
                    Kembali
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                {{ $student->name }}
                            </h3>
                            <p class="text-sm text-gray-500 mt-1">
                                NIS/NISN: {{ $student->identity_number }}
                            </p>
                        </div>

                        @if ($student->status === 'active')
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

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

                        <div>
                            <p class="text-sm text-gray-500">Nama Lengkap</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ $student->name }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">NIS/NISN</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ $student->identity_number }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Jenis Kelamin</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ $student->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Kelas</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ $student->classRoom->name }}
                            </p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $student->classRoom->code }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">No. Telepon</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ $student->phone ?: '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ $student->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                            </p>
                        </div>

                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500">Alamat</p>
                            <p class="mt-1 font-medium text-gray-900 whitespace-pre-line">
                                {{ $student->address ?: '-' }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>