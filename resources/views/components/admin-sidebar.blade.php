@php
    $navigation = [
        [
            'label' => 'Overview',
            'items' => [
                [
                    'label' => 'Dashboard',
                    'route' => 'dashboard',
                    'icon' => 'dashboard',
                ],
            ],
        ],
        [
            'label' => 'Master Data',
            'items' => [
                [
                    'label' => 'Akun',
                    'route' => 'users.index',
                    'icon' => 'users',
                ],
                [
                    'label' => 'Guru',
                    'route' => 'teachers.index',
                    'icon' => 'teacher',
                ],
                [
                    'label' => 'Siswa',
                    'route' => 'students.index',
                    'icon' => 'student',
                ],
                [
                    'label' => 'Kelas',
                    'route' => 'class-rooms.index',
                    'icon' => 'class',
                ],
                [
                    'label' => 'Jadwal Kelas',
                    'route' => 'schedules.index',
                    'icon' => 'schedule',
                ],
                [
                    'label' => 'SPP',
                    'route' => 'spp-bills.index',
                    'icon' => 'spp',
                ],
            ],
        ],
        [
            'label' => 'Account',
            'items' => [
                [
                    'label' => 'Profil',
                    'route' => 'profile.edit',
                    'icon' => 'profile',
                ],
            ],
        ],
    ];
@endphp

<div
    id="admin-overlay"
    class="fixed inset-0 z-40 hidden bg-slate-950/50 lg:hidden"
    onclick="closeAdminSidebar()"
></div>

<aside
    id="admin-sidebar"
    class="admin-scrollbar fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col overflow-y-auto border-r border-slate-200 bg-white transition-transform duration-200 lg:translate-x-0"
>
    <div class="flex h-16 shrink-0 items-center border-b border-slate-200 px-6">
        <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
            <div class="flex h-8 w-8 items-center justify-center rounded-md bg-slate-950 text-sm font-bold text-white">
                B
            </div>

            <div>
                <div class="text-sm font-semibold text-slate-950">
                    Bimbel
                </div>

                <div class="text-xs text-slate-500">
                    Admin Panel
                </div>
            </div>
        </a>
    </div>

    <div class="flex-1 px-3 py-5">
        @foreach ($navigation as $section)
            <div class="{{ !$loop->first ? 'mt-7' : '' }}">
                <div class="mb-2 px-3 text-[11px] font-semibold uppercase tracking-[0.08em] text-slate-400">
                    {{ $section['label'] }}
                </div>

                <nav class="space-y-1">
                    @foreach ($section['items'] as $item)
                        @php
                            $active = request()->routeIs($item['route']);
                        @endphp

                        <a
                            href="{{ route($item['route']) }}"
                            class="{{ $active
                                ? 'bg-slate-100 text-slate-950'
                                : 'text-slate-600 hover:bg-slate-100 hover:text-slate-950' }}
                                flex items-center gap-3 rounded-md px-3 py-2 text-sm font-medium transition"
                        >
                            @if ($item['icon'] === 'dashboard')
                                <svg
                                    class="h-4 w-4 shrink-0"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <rect x="3" y="3" width="7" height="7" rx="1"/>
                                    <rect x="14" y="3" width="7" height="7" rx="1"/>
                                    <rect x="3" y="14" width="7" height="7" rx="1"/>
                                    <rect x="14" y="14" width="7" height="7" rx="1"/>
                                </svg>
                            @elseif ($item['icon'] === 'users')
                                <svg
                                    class="h-4 w-4 shrink-0"
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
                            @elseif ($item['icon'] === 'teacher')
                                <svg
                                    class="h-4 w-4 shrink-0"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                    <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                                    <path d="M8 6h8"/>
                                    <path d="M8 10h6"/>
                                </svg>
                            @elseif ($item['icon'] === 'student')
                                <svg
                                    class="h-4 w-4 shrink-0"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path d="M22 10 12 5 2 10l10 5 10-5Z"/>
                                    <path d="M6 12.5V16c3 2 9 2 12 0v-3.5"/>
                                    <path d="M22 10v6"/>
                                </svg>
                            @elseif ($item['icon'] === 'class')
                                <svg
                                    class="h-4 w-4 shrink-0"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path d="M3 21h18"/>
                                    <path d="M5 21V5a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v16"/>
                                    <path d="M9 7h6"/>
                                    <path d="M9 11h6"/>
                                    <path d="M9 15h6"/>
                                </svg>
                            @elseif ($item['icon'] === 'schedule')
                                <svg
                                    class="h-4 w-4 shrink-0"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <circle cx="12" cy="12" r="9"/>
                                    <path d="M12 7v5l3 2"/>
                                </svg>
                            @elseif ($item['icon'] === 'spp')
                                <svg
                                    class="h-4 w-4 shrink-0"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <rect x="3" y="4" width="18" height="16" rx="2"/>
                                    <path d="M7 8h10"/>
                                    <path d="M7 12h10"/>
                                    <path d="M7 16h6"/>
                                </svg>
                            @else
                                <svg
                                    class="h-4 w-4 shrink-0"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <circle cx="12" cy="8" r="4"/>
                                    <path d="M4 21a8 8 0 0 1 16 0"/>
                                </svg>
                            @endif

                            <span>{{ $item['label'] }}</span>
                        </a>
                    @endforeach
                </nav>
            </div>
        @endforeach
    </div>

    <div class="border-t border-slate-200 p-4">
        <div class="flex items-center gap-3">
            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-slate-100 text-sm font-semibold text-slate-700">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <div class="min-w-0">
                <div class="truncate text-sm font-medium text-slate-900">
                    {{ auth()->user()->name }}
                </div>

                <div class="truncate text-xs text-slate-500">
                    Administrator
                </div>
            </div>
        </div>
    </div>
</aside>

<script>
    function openAdminSidebar() {
        document.getElementById('admin-sidebar').classList.remove('-translate-x-full');
        document.getElementById('admin-overlay').classList.remove('hidden');
    }

    function closeAdminSidebar() {
        document.getElementById('admin-sidebar').classList.add('-translate-x-full');
        document.getElementById('admin-overlay').classList.add('hidden');
    }
</script>
