<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Tambah Siswa
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Tambahkan data siswa baru ke sistem.
                </p>
            </div>

            <a
                href="{{ route('admin.students.index') }}"
                class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-200 px-6 py-5">
                    <h3 class="text-base font-semibold text-gray-900">
                        Informasi Siswa
                    </h3>
                    <p class="mt-1 text-sm text-gray-500">
                        Lengkapi data siswa dan tentukan kelasnya.
                    </p>
                </div>

                <form
                    method="POST"
                    action="{{ route('admin.students.store') }}"
                    class="p-6">
                    @csrf

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                        <div class="md:col-span-2">
                            <label
                                for="name"
                                class="mb-2 block text-sm font-medium text-gray-700">
                                Nama Lengkap
                            </label>

                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                class="w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Masukkan nama lengkap siswa">

                            @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="identity_number"
                                class="mb-2 block text-sm font-medium text-gray-700">
                                NIS / NISN
                            </label>

                            <input
                                id="identity_number"
                                name="identity_number"
                                type="text"
                                value="{{ old('identity_number') }}"
                                required
                                class="w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Masukkan NIS atau NISN">

                            @error('identity_number')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="gender"
                                class="mb-2 block text-sm font-medium text-gray-700">
                                Jenis Kelamin
                            </label>

                            <select
                                id="gender"
                                name="gender"
                                required
                                class="w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Pilih jenis kelamin</option>
                                <option
                                    value="male"
                                    @selected(old('gender')==='male' )>
                                    Laki-laki
                                </option>
                                <option
                                    value="female"
                                    @selected(old('gender')==='female' )>
                                    Perempuan
                                </option>
                            </select>

                            @error('gender')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="class_room_id"
                                class="mb-2 block text-sm font-medium text-gray-700">
                                Kelas
                            </label>

                            <select
                                id="class_room_id"
                                name="class_room_id"
                                required
                                class="w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Pilih kelas</option>

                                @forelse ($classRooms as $classRoom)
                                <option
                                    value="{{ $classRoom->id }}"
                                    @selected(old('class_room_id')==$classRoom->id)
                                    >
                                    {{ $classRoom->name }}
                                    @if ($classRoom->code)
                                    — {{ $classRoom->code }}
                                    @endif
                                </option>
                                @empty
                                <option value="" disabled>
                                    Belum ada kelas aktif
                                </option>
                                @endforelse
                            </select>

                            @error('class_room_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            @if ($classRooms->isEmpty())
                            <p class="mt-1 text-sm text-amber-600">
                                Belum ada kelas aktif. Buat data kelas terlebih dahulu.
                            </p>
                            @endif
                        </div>

                        <div>
                            <label
                                for="phone"
                                class="mb-2 block text-sm font-medium text-gray-700">
                                Nomor Telepon
                            </label>

                            <input
                                id="phone"
                                name="phone"
                                type="text"
                                value="{{ old('phone') }}"
                                class="w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Contoh: 081234567890">

                            @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="status"
                                class="mb-2 block text-sm font-medium text-gray-700">
                                Status
                            </label>

                            <select
                                id="status"
                                name="status"
                                required
                                class="w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option
                                    value="active"
                                    @selected(old('status', 'active' )==='active' )>
                                    Aktif
                                </option>

                                <option
                                    value="inactive"
                                    @selected(old('status')==='inactive' )>
                                    Tidak Aktif
                                </option>
                            </select>

                            @error('status')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label
                                for="address"
                                class="mb-2 block text-sm font-medium text-gray-700">
                                Alamat
                            </label>

                            <textarea
                                id="address"
                                name="address"
                                rows="4"
                                class="w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Masukkan alamat siswa">{{ old('address') }}</textarea>

                            @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex items-center justify-end gap-3 border-t border-gray-200 pt-6">
                        <a
                            href="{{ route('admin.students.index') }}"
                            class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
                            Simpan Siswa
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>