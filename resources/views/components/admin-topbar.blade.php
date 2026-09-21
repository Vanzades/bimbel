<header class="sticky top-0 z-30 flex h-16 items-center border-b border-slate-200 bg-white">
    <div class="flex w-full items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">

        <div class="flex items-center gap-3">
            <button
                type="button"
                onclick="openAdminSidebar()"
                class="inline-flex h-9 w-9 items-center justify-center rounded-md border border-slate-200 text-slate-600 hover:bg-slate-100 lg:hidden"
            >
                <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M4 6h16"/>
                    <path d="M4 12h16"/>
                    <path d="M4 18h16"/>
                </svg>
            </button>

            <div class="hidden items-center gap-2 text-sm sm:flex">
                <span class="text-slate-400">Admin</span>
                <span class="text-slate-300">/</span>
                <span class="font-medium text-slate-900">
                    {{ $title ?? 'Dashboard' }}
                </span>
            </div>
        </div>

        <div class="flex items-center gap-2">

            <div class="relative hidden md:block">
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
                    placeholder="Search..."
                    class="h-9 w-48 rounded-md border border-slate-200 bg-white pl-9 pr-3 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-slate-400 focus:ring-2 focus:ring-slate-200 lg:w-64"
                />
            </div>

            <div class="relative">
                <details class="group">
                    <summary class="flex h-9 cursor-pointer list-none items-center gap-2 rounded-md px-2 hover:bg-slate-100">
                        <div class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-100 text-xs font-semibold text-slate-700">
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        </div>

                        <span class="hidden max-w-32 truncate text-sm font-medium text-slate-700 lg:block">
                            {{ auth()->user()->name }}
                        </span>

                        <svg class="hidden h-4 w-4 text-slate-400 lg:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="m6 9 6 6 6-6"/>
                        </svg>
                    </summary>

                    <div class="absolute right-0 top-11 z-50 w-56 rounded-md border border-slate-200 bg-white p-1 shadow-lg">
                        <div class="border-b border-slate-100 px-3 py-3">
                            <div class="truncate text-sm font-medium text-slate-900">
                                {{ auth()->user()->name }}
                            </div>

                            <div class="truncate text-xs text-slate-500">
                                {{ auth()->user()->email }}
                            </div>
                        </div>

                        <a
                            href="{{ route('profile.edit') }}"
                            class="mt-1 flex items-center rounded px-3 py-2 text-sm text-slate-600 hover:bg-slate-100"
                        >
                            Profil
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button
                                type="submit"
                                class="flex w-full items-center rounded px-3 py-2 text-sm text-red-600 hover:bg-red-50"
                            >
                                Logout
                            </button>
                        </form>
                    </div>
                </details>
            </div>
        </div>
    </div>
</header>
