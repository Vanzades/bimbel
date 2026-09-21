<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Detail Akun Pengguna
                </h2>
                <p class="text-sm text-gray-500 mt-1">
                    Informasi akun dan data yang terhubung
                </p>
            </div>

            <div class="flex items-center gap-2">
                <a
                    href="{{ route('users.edit', $user) }}"
                    class="inline-flex items-center px-4 py-2 bg-indigo-600 rounded-lg text-sm font-medium text-white hover:bg-indigo-700">
                    Edit
                </a>

                <a
                    href="{{ route('users.index') }}"
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
                                {{ $user->name }}
                            </h3>

                            <p class="text-sm text-gray-500 mt-1">
                                {{ $user->email }}
                            </p>
                        </div>

                        @if ($user->role === 'admin')
                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-700">
                            Admin
                        </span>
                        @elseif ($user->role === 'guru')
                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                            Guru
                        </span>
                        @else
                        <span class="inline-flex px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700">
                            Siswa
                        </span>
                        @endif
                    </div>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

                        <div>
                            <p class="text-sm text-gray-500">Nama</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ $user->name }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ $user->email }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Role</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ ucfirst($user->role) }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Dibuat</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ $user->created_at->format('d M Y H:i') }}
                            </p>
                        </div>

                    </div>
                </div>

            </div>

            @if ($user->teacher)
            <div class="mt-6 bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Data Guru Terhubung
                    </h3>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

                        <div>
                            <p class="text-sm text-gray-500">Nama</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ $user->teacher->name }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">NIP/NIK</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ $user->teacher->identity_number }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Jenis Kelamin</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ $user->teacher->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">No. Telepon</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ $user->teacher->phone ?: '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ $user->teacher->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            @elseif ($user->student)
            <div class="mt-6 bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">
                        Data Siswa Terhubung
                    </h3>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">

                        <div>
                            <p class="text-sm text-gray-500">Nama</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ $user->student->name }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">NIS/NISN</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ $user->student->identity_number }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Jenis Kelamin</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ $user->student->gender === 'male' ? 'Laki-laki' : 'Perempuan' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Kelas</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ $user->student->classRoom->name }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">No. Telepon</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ $user->student->phone ?: '-' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Status</p>
                            <p class="mt-1 font-medium text-gray-900">
                                {{ $user->student->status === 'active' ? 'Aktif' : 'Tidak Aktif' }}
                            </p>
                        </div>

                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>