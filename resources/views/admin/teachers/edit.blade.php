<x-admin-layout>
    <x-slot name="title">
        Edit Guru
    </x-slot>

    <div class="space-y-6">

        <div class="flex items-center gap-3">
            <div>
                <h1 class="text-2xl font-semibold tracking-tight text-slate-950">
                    Edit Guru
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Perbarui informasi guru yang dipilih.
                </p>
            </div>
        </div>

        @if ($errors->any())
            <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3">
                <div class="text-sm font-medium text-red-800">
                    Periksa kembali data yang dimasukkan.
                </div>

                <ul class="mt-2 space-y-1 text-sm text-red-700">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form
            method="POST"
            action="{{ route('admin.teachers.update', $teacher) }}"
            class="rounded-lg border border-slate-200 bg-white"
        >
            @csrf
            @method('PUT')

            <div class="border-b border-slate-200 px-5 py-4">
                <h2 class="text-sm font-semibold text-slate-950">
                    Informasi Guru
                </h2>

                <p class="mt-1 text-xs text-slate-500">
                    Perbarui informasi dasar guru sesuai kebutuhan.
                </p>
            </div>

            <div class="grid gap-6 p-5 md:grid-cols-2">

                <div class="md:col-span-2">
                    <label
                        for="name"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Nama Lengkap
                    </label>

                    <input
                        id="name"
                        name="name"
                        type="text"
                        value="{{ old('name', $teacher->name) }}"
                        required
                        autofocus
                        class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                    >

                    @error('name')
                        <p class="mt-1.5 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label
                        for="identity_number"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        NIK / Nomor Identitas
                    </label>

                    <input
                        id="identity_number"
                        name="identity_number"
                        type="text"
                        value="{{ old('identity_number', $teacher->identity_number) }}"
                        required
                        class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                    >

                    @error('identity_number')
                        <p class="mt-1.5 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label
                        for="gender"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Jenis Kelamin
                    </label>

                    <select
                        id="gender"
                        name="gender"
                        required
                        class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                    >
                        <option value="">Pilih jenis kelamin</option>

                        <option
                            value="male"
                            @selected(old('gender', $teacher->gender) === 'male')
                        >
                            Laki-laki
                        </option>

                        <option
                            value="female"
                            @selected(old('gender', $teacher->gender) === 'female')
                        >
                            Perempuan
                        </option>
                    </select>

                    @error('gender')
                        <p class="mt-1.5 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label
                        for="email"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Email
                    </label>

                    <input
                        id="email"
                        name="email"
                        type="email"
                        value="{{ old('email', $teacher->email) }}"
                        placeholder="contoh@email.com"
                        class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                    >

                    @error('email')
                        <p class="mt-1.5 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label
                        for="phone"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Nomor Telepon
                    </label>

                    <input
                        id="phone"
                        name="phone"
                        type="text"
                        value="{{ old('phone', $teacher->phone) }}"
                        placeholder="08xxxxxxxxxx"
                        class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                    >

                    @error('phone')
                        <p class="mt-1.5 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div>
                    <label
                        for="status"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                        required
                        class="h-10 w-full rounded-md border border-slate-200 bg-white px-3 text-sm text-slate-700 outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                    >
                        <option
                            value="active"
                            @selected(old('status', $teacher->status) === 'active')
                        >
                            Aktif
                        </option>

                        <option
                            value="inactive"
                            @selected(old('status', $teacher->status) === 'inactive')
                        >
                            Nonaktif
                        </option>
                    </select>

                    @error('status')
                        <p class="mt-1.5 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="md:col-span-2">
                    <label
                        for="address"
                        class="mb-2 block text-sm font-medium text-slate-700"
                    >
                        Alamat
                    </label>

                    <textarea
                        id="address"
                        name="address"
                        rows="4"
                        placeholder="Masukkan alamat lengkap"
                        class="w-full resize-none rounded-md border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 outline-none transition placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-100"
                    >{{ old('address', $teacher->address) }}</textarea>

                    @error('address')
                        <p class="mt-1.5 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

            </div>

            <div class="flex flex-col-reverse gap-2 border-t border-slate-200 bg-slate-50 px-5 py-4 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('admin.teachers.index') }}"
                    class="inline-flex h-9 items-center justify-center rounded-md border border-slate-200 bg-white px-4 text-sm font-medium text-slate-700 transition hover:bg-slate-50"
                >
                    Batal
                </a>

                <button
                    type="submit"
                    class="inline-flex h-9 items-center justify-center rounded-md bg-slate-950 px-4 text-sm font-medium text-white transition hover:bg-slate-800"
                >
                    Simpan Perubahan
                </button>

            </div>
        </form>

    </div>
</x-admin-layout>
