@extends('admin.layouts.app')

@section('title', 'Users - Admin')
@section('page-title', 'User Management')
@section('page-subtitle', 'Manage admin, manager and editor accounts')

@section('body')

{{-- ============ STATS ============ --}}
<div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3 mb-6">
    <div class="bg-white rounded-lg shadow-sm p-3 border-l-4 border-brandPink">
        <p class="text-xs text-slate-500">Total</p>
        <h3 class="text-xl font-bold text-slate-800">{{ $stats['total'] }}</h3>
    </div>
    <div class="bg-white rounded-lg shadow-sm p-3 border-l-4 border-purple-500">
        <p class="text-xs text-slate-500">Admins</p>
        <h3 class="text-xl font-bold text-slate-800">{{ $stats['admin'] }}</h3>
    </div>
    <div class="bg-white rounded-lg shadow-sm p-3 border-l-4 border-blue-500">
        <p class="text-xs text-slate-500">Managers</p>
        <h3 class="text-xl font-bold text-slate-800">{{ $stats['manager'] }}</h3>
    </div>
    <div class="bg-white rounded-lg shadow-sm p-3 border-l-4 border-teal-500">
        <p class="text-xs text-slate-500">Editors</p>
        <h3 class="text-xl font-bold text-slate-800">{{ $stats['editor'] }}</h3>
    </div>
    <div class="bg-white rounded-lg shadow-sm p-3 border-l-4 border-green-500">
        <p class="text-xs text-slate-500">Active</p>
        <h3 class="text-xl font-bold text-slate-800">{{ $stats['active'] }}</h3>
    </div>
    <div class="bg-white rounded-lg shadow-sm p-3 border-l-4 border-red-500">
        <p class="text-xs text-slate-500">Inactive</p>
        <h3 class="text-xl font-bold text-slate-800">{{ $stats['inactive'] }}</h3>
    </div>
</div>

{{-- ============ FILTERS + ADD ============ --}}
<form method="GET" class="flex flex-wrap items-center gap-3 mb-5">
    <input type="text" name="search" value="{{ request('search') }}"
           placeholder="Search name, email, phone..."
           class="flex-1 min-w-[220px] px-4 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">

    <select name="role" class="px-4 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
        <option value="">All Roles</option>
        <option value="admin" @selected(request('role') === 'admin')>Admin</option>
        <option value="manager" @selected(request('role') === 'manager')>Manager</option>
        <option value="editor" @selected(request('role') === 'editor')>Editor</option>
    </select>

    <select name="status" class="px-4 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
        <option value="">All Status</option>
        <option value="active" @selected(request('status') === 'active')>Active</option>
        <option value="inactive" @selected(request('status') === 'inactive')>Inactive</option>
    </select>

    <button class="px-4 py-2 bg-slate-800 text-white rounded-lg text-sm font-semibold hover:bg-slate-700">
        <i class="fa-solid fa-filter"></i> Filter
    </button>

    <a href="{{ route('admin.users.index') }}" class="px-4 py-2 bg-slate-100 text-slate-700 rounded-lg text-sm font-semibold hover:bg-slate-200">
        Reset
    </a>

    <button type="button" onclick="openUserModal()"
            class="ml-auto bg-brandPink text-white px-5 py-2.5 rounded-lg text-sm font-semibold hover:bg-pink-700 flex items-center gap-2">
        <i class="fa-solid fa-plus"></i> Add New User
    </button>
</form>

{{-- ============ TABLE ============ --}}
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-600 uppercase text-xs">
                <tr>
                    <th class="px-5 py-3 text-left font-semibold">User</th>
                    <th class="px-5 py-3 text-left font-semibold">Contact</th>
                    <th class="px-5 py-3 text-left font-semibold">Role</th>
                    <th class="px-5 py-3 text-left font-semibold">Status</th>
                    <th class="px-5 py-3 text-left font-semibold">Joined</th>
                    <th class="px-5 py-3 text-right font-semibold">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($users as $user)
                    <tr class="hover:bg-slate-50 transition">
                        <td class="px-5 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-brandPink to-purple-500 text-white flex items-center justify-center font-bold">
                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-800">{{ $user->name }}</p>
                                    <p class="text-xs text-slate-500">{{ $user->email }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-4 text-slate-600 text-sm">
                            {{ $user->phone ?? '—' }}
                        </td>
                        <td class="px-5 py-4">
                            @php
                                $roleColors = [
                                    'admin'   => 'bg-purple-100 text-purple-700',
                                    'manager' => 'bg-blue-100 text-blue-700',
                                    'editor'  => 'bg-teal-100 text-teal-700',
                                ];
                            @endphp
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $roleColors[$user->role] ?? '' }}">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>
                        <td class="px-5 py-4">
                            @if($user->status === 'active')
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                    <i class="fa-solid fa-circle-check"></i> Active
                                </span>
                            @else
                                <span class="px-2.5 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                    <i class="fa-solid fa-circle-xmark"></i> Inactive
                                </span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-slate-500 text-xs">
                            {{ $user->created_at->format('d M Y') }}
                        </td>
                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-2">
                                <button onclick='openUserViewModal(@json($user))'
                                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-100"
                                        title="View">
                                    <i class="fa-solid fa-eye text-xs"></i>
                                </button>

                                <button onclick='openUserModal(@json($user))'
                                        class="w-8 h-8 flex items-center justify-center rounded-lg bg-yellow-50 text-yellow-600 hover:bg-yellow-100"
                                        title="Edit">
                                    <i class="fa-solid fa-pen text-xs"></i>
                                </button>

                                <button onclick="toggleUserStatus({{ $user->id }})"
                                        class="w-8 h-8 flex items-center justify-center rounded-lg {{ $user->status === 'active' ? 'bg-orange-50 text-orange-600 hover:bg-orange-100' : 'bg-green-50 text-green-600 hover:bg-green-100' }}"
                                        title="{{ $user->status === 'active' ? 'Deactivate' : 'Activate' }}">
                                    <i class="fa-solid {{ $user->status === 'active' ? 'fa-user-slash' : 'fa-user-check' }} text-xs"></i>
                                </button>

                                @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST"
                                          onsubmit="return confirm('Delete this user?')">
                                        @csrf @method('DELETE')
                                        <button class="w-8 h-8 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-100"
                                                title="Delete">
                                            <i class="fa-solid fa-trash text-xs"></i>
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-10 text-center text-slate-500">
                            <i class="fa-regular fa-folder-open text-3xl mb-2 block"></i>
                            No users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-5 py-3 border-t border-slate-100">
        {{ $users->links() }}
    </div>
</div>

{{-- ============= USER MODAL (Create / Edit) ============= --}}
<div id="userModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-lg max-h-[90vh] overflow-y-auto">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between sticky top-0 bg-white z-10">
            <h3 id="userModalTitle" class="text-lg font-bold text-slate-800">Add New User</h3>
            <button onclick="closeUserModal()" class="text-slate-400 hover:text-slate-700 text-2xl leading-none">&times;</button>
        </div>

        <form id="userForm" method="POST" action="{{ route('admin.users.store') }}" class="p-6 space-y-4">
            @csrf
            <input type="hidden" name="_method" id="userMethod" value="POST">

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">Full Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="u_name" required
                       class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Email <span class="text-red-500">*</span></label>
                    <input type="email" name="email" id="u_email" required
                           class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Phone</label>
                    <input type="text" name="phone" id="u_phone" placeholder="+880 1XXXXXXXXX"
                           class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-sm font-semibold text-slate-700 mb-1">
                    Password <span class="text-red-500" id="pwdRequired">*</span>
                    <span class="text-xs text-slate-400 font-normal" id="pwdHint"></span>
                </label>
                <input type="password" name="password" id="u_password" autocomplete="new-password"
                       class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Role <span class="text-red-500">*</span></label>
                    <select name="role" id="u_role" required
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
                        <option value="admin">Admin</option>
                        <option value="manager">Manager</option>
                        <option value="editor" selected>Editor</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-semibold text-slate-700 mb-1">Status <span class="text-red-500">*</span></label>
                    <select name="status" id="u_status" required
                            class="w-full px-3 py-2 border border-slate-200 rounded-lg text-sm focus:ring-2 focus:ring-brandPink focus:outline-none">
                        <option value="active" selected>Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-100">
                <button type="button" onclick="closeUserModal()"
                        class="px-4 py-2 rounded-lg text-sm font-semibold bg-slate-100 text-slate-700 hover:bg-slate-200">
                    Cancel
                </button>
                <button type="submit"
                        class="px-5 py-2 rounded-lg text-sm font-semibold bg-brandPink text-white hover:bg-pink-700">
                    <i class="fa-solid fa-check mr-1"></i> Save User
                </button>
            </div>
        </form>
    </div>
</div>

{{-- ============= USER VIEW MODAL ============= --}}
<div id="userViewModal" class="fixed inset-0 bg-black/50 hidden z-50 flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-lg font-bold text-slate-800">User Details</h3>
            <button onclick="closeUserViewModal()" class="text-slate-400 hover:text-slate-700 text-2xl leading-none">&times;</button>
        </div>
        <div class="p-6">
            <div class="flex flex-col items-center mb-5">
                <div id="uv_avatar"
                     class="w-20 h-20 rounded-full bg-gradient-to-br from-brandPink to-purple-500 text-white flex items-center justify-center text-3xl font-bold mb-3"></div>
                <h3 id="uv_name" class="text-lg font-bold text-slate-800"></h3>
                <p id="uv_email" class="text-sm text-slate-500"></p>
            </div>

            <div class="space-y-3 text-sm">
                <div class="flex justify-between border-b border-slate-100 pb-2">
                    <span class="text-slate-500">Phone:</span>
                    <span id="uv_phone" class="font-semibold text-slate-800"></span>
                </div>
                <div class="flex justify-between border-b border-slate-100 pb-2">
                    <span class="text-slate-500">Role:</span>
                    <span id="uv_role" class="font-semibold text-slate-800"></span>
                </div>
                <div class="flex justify-between border-b border-slate-100 pb-2">
                    <span class="text-slate-500">Status:</span>
                    <span id="uv_status" class="font-semibold text-slate-800"></span>
                </div>
                <div class="flex justify-between border-b border-slate-100 pb-2">
                    <span class="text-slate-500">Joined:</span>
                    <span id="uv_joined" class="font-semibold text-slate-800"></span>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    const USERS_BASE = "{{ url('admin/users') }}";
    const CSRF = "{{ csrf_token() }}";

    /* ============ CREATE / EDIT MODAL ============ */
    function openUserModal(user = null) {
        const modal  = document.getElementById('userModal');
        const form   = document.getElementById('userForm');
        const title  = document.getElementById('userModalTitle');
        const method = document.getElementById('userMethod');
        const pwd    = document.getElementById('u_password');
        const req    = document.getElementById('pwdRequired');
        const hint   = document.getElementById('pwdHint');

        form.reset();

        if (user) {
            title.textContent = 'Edit User';
            form.action = USERS_BASE + '/' + user.id;
            method.value = 'PUT';

            document.getElementById('u_name').value   = user.name;
            document.getElementById('u_email').value  = user.email;
            document.getElementById('u_phone').value  = user.phone ?? '';
            document.getElementById('u_role').value   = user.role;
            document.getElementById('u_status').value = user.status;

            pwd.required = false;
            req.style.display = 'none';
            hint.textContent = ' — leave blank to keep current password';
        } else {
            title.textContent = 'Add New User';
            form.action = USERS_BASE;
            method.value = 'POST';

            pwd.required = true;
            req.style.display = 'inline';
            hint.textContent = '';
        }

        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeUserModal() {
        const modal = document.getElementById('userModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    /* ============ VIEW MODAL ============ */
    function openUserViewModal(user) {
        document.getElementById('uv_avatar').textContent = user.name.charAt(0).toUpperCase();
        document.getElementById('uv_name').textContent   = user.name;
        document.getElementById('uv_email').textContent  = user.email;
        document.getElementById('uv_phone').textContent  = user.phone ?? '—';
        document.getElementById('uv_role').textContent   = user.role.charAt(0).toUpperCase() + user.role.slice(1);
        document.getElementById('uv_status').textContent = user.status.charAt(0).toUpperCase() + user.status.slice(1);
        document.getElementById('uv_joined').textContent = new Date(user.created_at).toLocaleDateString('en-GB', {
            day: '2-digit', month: 'short', year: 'numeric'
        });

        const modal = document.getElementById('userViewModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }

    function closeUserViewModal() {
        const modal = document.getElementById('userViewModal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    /* ============ TOGGLE STATUS ============ */
    function toggleUserStatus(id) {
        if (!confirm('Change this user\'s status?')) return;

        fetch(USERS_BASE + '/' + id + '/toggle-status', {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': CSRF,
                'Accept': 'application/json',
            },
        })
        .then(r => r.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert(data.error || 'Something went wrong.');
            }
        })
        .catch(() => alert('Request failed.'));
    }

    /* ============ CLOSE ON BACKDROP CLICK ============ */
    ['userModal', 'userViewModal'].forEach(id => {
        const el = document.getElementById(id);
        if (el) el.addEventListener('click', e => { if (e.target === el) el.classList.add('hidden'); });
    });
</script>
@endpush

@endsection