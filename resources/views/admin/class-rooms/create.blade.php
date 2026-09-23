<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-800">
                    Tambah Kelas
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    Tambahkan kelas baru ke sistem.
                </p>
            </div>

            <a
                href="{{ route('admin.class-rooms.index') }}"
                class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                Kembali
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="mx-auto max-w-3xl px-4 sm:px-6 lg:px-8">
            <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
                <div class="border-b border-gray-200 px-6 py-5">
                    <h3 class="text-base font-semibold text-gray-900">
                        Informasi Kelas
                    </h3>

                    <p class="mt-1 text-sm text-gray-500">
                        Masukkan informasi kelas yang akan digunakan untuk mengelompokkan siswa.
                    </p>
                </div>

                <form
                    method="POST"
                    action="{{ route('admin.class-rooms.store') }}"
                    class="p-6">
                    @csrf

                    <div class="space-y-6">
                        <div>
                            <label
                                for="name"
                                class="mb-2 block text-sm font-medium text-gray-700">
                                Nama Kelas
                            </label>

                            <input
                                id="name"
                                name="name"
                                type="text"
                                value="{{ old('name') }}"
                                required
                                autofocus
                                class="w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Contoh: Matematika Dasar">

                            @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label
                                for="code"
                                class="mb-2 block text-sm font-medium text-gray-700">
                                Kode Kelas
                            </label>

                            <input
                                id="code"
                                name="code"
                                type="text"
                                value="{{ old('code') }}"
                                required
                                class="w-full rounded-lg border-gray-300 text-sm uppercase shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Contoh: MTK-DASAR">

                            @error('code')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <p class="mt-1 text-xs text-gray-500">
                                Kode kelas harus berbeda dari kelas lainnya.
                            </p>
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

                        <div>
                            <label
                                for="description"
                                class="mb-2 block text-sm font-medium text-gray-700">
                                Deskripsi
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                class="w-full rounded-lg border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                placeholder="Tambahkan deskripsi kelas jika diperlukan">{{ old('description') }}</textarea>

                            @error('description')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex items-center justify-end gap-3 border-t border-gray-200 pt-6">
                        <a
                            href="{{ route('admin.class-rooms.index') }}"
                            class="rounded-lg border border-gray-300 px-5 py-2.5 text-sm font-medium text-gray-700 transition hover:bg-gray-50">
                            Batal
                        </a>

                        <button
                            type="submit"
                            class="rounded-lg bg-indigo-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-indigo-700">
                            Simpan Kelas
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>