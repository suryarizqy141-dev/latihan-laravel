@php
    $user = auth()->user();
    $initial = mb_strtoupper(mb_substr($user->name, 0, 1));
    $currentTab = old('_form', $activeTab);

    $tabMeta = [
        'users' => [
            'label' => 'User',
            'description' => 'Kelola akun pengguna, role, dan data profil.',
            'count' => $stats['users'],
        ],
        'categories' => [
            'label' => 'Kategori',
            'description' => 'Atur kategori yang dipakai untuk mengelompokkan data.',
            'count' => $stats['categories'],
        ],
        'posts' => [
            'label' => 'Post',
            'description' => 'Tulis, ubah, dan hapus konten post.',
            'count' => $stats['posts'],
        ],
    ];

    $tabClass = fn (string $tab) => $tab === $currentTab
        ? 'bg-white text-indigo-700 shadow-sm'
        : 'text-slate-500 hover:text-slate-800';

    $userAction = $editUser
        ? url('/user/update/' . $editUser->id)
        : url('/user');
    $categoryAction = $editCategory
        ? url('/categories/' . $editCategory->id)
        : url('/categories');
    $postAction = $editPost
        ? url('/posts/' . $editPost->id)
        : url('/posts');
@endphp

<x-app-layout title="Belajar CRUD" subtitle="Semua fitur CRUD dalam satu dashboard">
    <section class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-indigo-700 to-slate-900 p-6 sm:p-8">
        <div class="pointer-events-none absolute -right-16 -top-20 h-64 w-64 rounded-full bg-rose-500/25 blur-3xl"></div>
        <div class="relative flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex items-center gap-4">
                <span
                    class="flex h-14 w-14 shrink-0 items-center justify-center rounded-2xl bg-white text-xl font-bold text-indigo-700 shadow-lg">
                    {{ $initial }}
                </span>
                <div>
                    <p class="text-sm text-indigo-200">Selamat datang kembali,</p>
                    <h2 class="text-2xl font-bold tracking-tight text-white">{{ $user->name }}</h2>
                    <div class="mt-2 flex flex-wrap items-center gap-2">
                        <span
                            class="badge {{ $user->role === 'admin' ? 'bg-rose-500/20 text-rose-100' : 'bg-emerald-500/20 text-emerald-100' }}">
                            {{ $user->role === 'admin' ? 'Administrator' : 'User' }}
                        </span>
                        <span class="text-xs text-indigo-200">{{ $user->email }}</span>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap gap-2">
                <a href="{{ url('/') }}" class="btn border border-white/20 bg-white/10 text-white hover:bg-white/20">
                    Lihat modul
                </a>
                @if ($user->role === 'admin')
                    <a href="{{ url('/admin') }}" class="btn bg-white text-indigo-700 hover:bg-indigo-50">
                        Admin area
                    </a>
                @endif
            </div>
        </div>
    </section>

    <section class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
        @foreach ([
            ['label' => 'Total user', 'value' => $stats['users'], 'tone' => 'bg-indigo-50 text-indigo-600'],
            ['label' => 'Administrator', 'value' => $stats['admins'], 'tone' => 'bg-rose-50 text-rose-600'],
            ['label' => 'Kategori', 'value' => $stats['categories'], 'tone' => 'bg-amber-50 text-amber-600'],
            ['label' => 'Post', 'value' => $stats['posts'], 'tone' => 'bg-emerald-50 text-emerald-600'],
        ] as $card)
            <div class="card flex items-center justify-between p-5">
                <div>
                    <p class="text-xs font-medium uppercase tracking-wider text-slate-400">{{ $card['label'] }}</p>
                    <p class="mt-1 text-2xl font-bold tracking-tight text-slate-900">{{ $card['value'] }}</p>
                </div>
                <span class="flex h-10 w-10 items-center justify-center rounded-xl {{ $card['tone'] }}">
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                    </svg>
                </span>
            </div>
        @endforeach
    </section>

    @if ($errors->any())
        <div class="mt-6 rounded-xl border border-rose-200 bg-rose-50 p-4">
            <p class="text-sm font-semibold text-rose-700">
                Ada {{ $errors->count() }} data yang perlu diperbaiki.
            </p>
            <ul class="mt-2 space-y-1 pl-5 text-sm text-rose-600">
                @foreach ($errors->all() as $error)
                    <li class="list-disc">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section class="mt-6">
        <div class="flex flex-col gap-3 rounded-2xl border border-slate-200 bg-white p-2 shadow-sm sm:flex-row sm:items-center sm:justify-between">
            <div class="flex flex-1 flex-wrap gap-1" role="tablist" aria-label="Pilih data CRUD">
                @foreach ($tabMeta as $key => $meta)
                    <a href="{{ url('/dashboard') }}?tab={{ $key }}" data-crud-tab="{{ $key }}"
                        data-description="{{ $meta['description'] }}"
                        class="inline-flex items-center gap-2 rounded-xl px-4 py-2.5 text-sm font-semibold transition {{ $tabClass($key) }}"
                        aria-selected="{{ $currentTab === $key ? 'true' : 'false' }}">
                        {{ $meta['label'] }}
                        <span class="badge badge-slate">{{ $meta['count'] }}</span>
                    </a>
                @endforeach
            </div>
            <p id="crud-tab-description" class="px-3 text-xs text-slate-500 sm:text-right">
                {{ $tabMeta[$currentTab]['description'] ?? '' }}
            </p>
        </div>

        <div class="mt-5">
            <div data-crud-panel="users" class="{{ $currentTab === 'users' ? '' : 'hidden' }}">
                <div class="grid gap-6 xl:grid-cols-[1.5fr_1fr]">
                    <section class="card overflow-hidden">
                        <div class="border-b border-slate-200 p-5 sm:p-6">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <h2 class="text-base font-semibold text-slate-900">Daftar user</h2>
                                    <p class="mt-0.5 text-sm text-slate-500">
                                        {{ $users->total() }} user terdaftar.
                                    </p>
                                </div>
                                <span class="badge badge-indigo">{{ $users->total() }} data</span>
                            </div>

                            <form method="GET" action="{{ url('/dashboard') }}" class="mt-4 flex gap-2">
                                <input type="hidden" name="tab" value="users">
                                <input type="search" name="q" value="{{ $search }}" placeholder="Cari nama, email, atau alamat..."
                                    class="input flex-1">
                                <button type="submit" class="btn btn-primary">Cari</button>
                                @if ($search !== '')
                                    <a href="{{ url('/dashboard') }}?tab=users" class="btn btn-secondary">Reset</a>
                                @endif
                            </form>
                        </div>

                        @if ($users->isEmpty())
                            <div class="px-6 py-12 text-center">
                                <p class="text-sm font-semibold text-slate-700">Belum ada user.</p>
                                <p class="mt-1 text-sm text-slate-500">Tambahkan user melalui form di samping.</p>
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-slate-200">
                                    <thead class="bg-slate-50">
                                        <tr>
                                            <th class="table-th">User</th>
                                            <th class="table-th hidden md:table-cell">Alamat</th>
                                            <th class="table-th">Role</th>
                                            <th class="table-th text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @foreach ($users as $row)
                                            <tr class="transition hover:bg-slate-50/70">
                                                <td class="table-td">
                                                    <div class="flex items-center gap-3">
                                                        <span
                                                            class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-sm font-bold text-indigo-600">
                                                            {{ mb_strtoupper(mb_substr($row->name, 0, 1)) }}
                                                        </span>
                                                        <div class="min-w-0">
                                                            <p class="truncate font-semibold text-slate-800">{{ $row->name }}</p>
                                                            <p class="truncate text-xs text-slate-500">{{ $row->email }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="table-td hidden md:table-cell">
                                                    <span class="line-clamp-2 max-w-56 text-slate-600">{{ $row->alamat ?: '-' }}</span>
                                                </td>
                                                <td class="table-td">
                                                    <span class="badge {{ $row->role === 'admin' ? 'badge-rose' : 'badge-indigo' }}">
                                                        {{ $row->role === 'admin' ? 'Admin' : 'User' }}
                                                    </span>
                                                </td>
                                                <td class="table-td">
                                                    <div class="flex items-center justify-end gap-1">
                                                        <a href="{{ url('/dashboard') }}?tab=users&edit={{ $row->id }}"
                                                            class="btn btn-ghost btn-sm text-indigo-600 hover:bg-indigo-50 hover:text-indigo-700">
                                                            Edit
                                                        </a>
                                                        <form method="POST" action="{{ url('/user/' . $row->id) }}"
                                                            onsubmit="return confirm('Hapus user {{ $row->name }}?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="from" value="dashboard">
                                                            <button type="submit"
                                                                class="btn btn-ghost btn-sm text-rose-600 hover:bg-rose-50 hover:text-rose-700">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if ($users->hasPages())
                                <div class="border-t border-slate-200 px-5 py-4 sm:px-6">
                                    {{ $users->links() }}
                                </div>
                            @endif
                        @endif
                    </section>

                    <aside>
                        <form action="{{ $userAction }}" method="POST" class="card p-5 sm:p-6">
                            @csrf
                            <input type="hidden" name="from" value="dashboard">
                            <input type="hidden" name="_form" value="users">

                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <h2 class="text-base font-semibold text-slate-900">
                                        {{ $editUser ? 'Edit user' : 'Tambah user' }}
                                    </h2>
                                    <p class="text-xs text-slate-500">
                                        {{ $editUser ? 'Perbarui data user terpilih.' : 'Simpan user baru langsung ke database.' }}
                                    </p>
                                </div>
                                @if ($editUser)
                                    <a href="{{ url('/dashboard') }}?tab=users" class="btn btn-secondary btn-sm">Batal</a>
                                @endif
                            </div>

                            <div class="mt-5 grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="user-name" class="label">Nama lengkap</label>
                                    <input type="text" id="user-name" name="name"
                                        value="{{ old('name', $editUser->name ?? '') }}" required class="input">
                                    @error('name')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="user-email" class="label">Email</label>
                                    <input type="email" id="user-email" name="email"
                                        value="{{ old('email', $editUser->email ?? '') }}" required class="input">
                                    @error('email')
                                        <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="user-password" class="label">Password</label>
                                <input type="password" id="user-password" name="password"
                                    placeholder="{{ $editUser ? 'Biarkan kosong jika tidak diubah' : 'Minimal 6 karakter' }}"
                                    class="input" @required(!$editUser)>
                                @error('password')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-4 grid gap-4 sm:grid-cols-2">
                                <div>
                                    <label for="user-role" class="label">Role</label>
                                    <select id="user-role" name="role" class="input">
                                        <option value="user" @selected(old('role', $editUser->role ?? 'user') === 'user')>User</option>
                                        <option value="admin" @selected(old('role', $editUser->role ?? '') === 'admin')>Admin</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="user-birth" class="label">Tanggal lahir</label>
                                    <input type="date" id="user-birth" name="tanggal_lahir"
                                        value="{{ old('tanggal_lahir', $editUser?->tanggal_lahir?->format('Y-m-d') ?? '') }}"
                                        class="input">
                                </div>
                            </div>

                            <div class="mt-4">
                                <label for="user-address" class="label">Alamat</label>
                                <textarea id="user-address" name="alamat" rows="2" class="input resize-none">{{ old('alamat', $editUser->alamat ?? '') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-primary mt-5 w-full">
                                {{ $editUser ? 'Simpan perubahan' : 'Tambah user' }}
                            </button>
                        </form>
                    </aside>
                </div>
            </div>

            <div data-crud-panel="categories" class="{{ $currentTab === 'categories' ? '' : 'hidden' }}">
                <div class="grid gap-6 xl:grid-cols-[1.5fr_1fr]">
                    <section class="card overflow-hidden">
                        <div class="border-b border-slate-200 p-5 sm:p-6">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <h2 class="text-base font-semibold text-slate-900">Daftar kategori</h2>
                                    <p class="mt-0.5 text-sm text-slate-500">{{ $categories->total() }} kategori terdaftar.</p>
                                </div>
                                <span class="badge badge-amber">{{ $categories->total() }} data</span>
                            </div>

                            <form method="GET" action="{{ url('/dashboard') }}" class="mt-4 flex gap-2">
                                <input type="hidden" name="tab" value="categories">
                                <input type="search" name="q" value="{{ $search }}" placeholder="Cari kategori..."
                                    class="input flex-1">
                                <button type="submit" class="btn btn-primary">Cari</button>
                                @if ($search !== '')
                                    <a href="{{ url('/dashboard') }}?tab=categories" class="btn btn-secondary">Reset</a>
                                @endif
                            </form>
                        </div>

                        @if ($categories->isEmpty())
                            <div class="px-6 py-12 text-center">
                                <p class="text-sm font-semibold text-slate-700">Belum ada kategori.</p>
                                <p class="mt-1 text-sm text-slate-500">Tambahkan kategori melalui form di samping.</p>
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-slate-200">
                                    <thead class="bg-slate-50">
                                        <tr>
                                            <th class="table-th">Kategori</th>
                                            <th class="table-th hidden md:table-cell">Dibuat</th>
                                            <th class="table-th text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @foreach ($categories as $row)
                                            <tr class="transition hover:bg-slate-50/70">
                                                <td class="table-td">
                                                    <p class="font-semibold text-slate-800">{{ $row->name }}</p>
                                                    <p class="mt-0.5 line-clamp-2 max-w-md text-xs leading-relaxed text-slate-500">
                                                        {{ $row->description ?: 'Tanpa deskripsi' }}
                                                    </p>
                                                </td>
                                                <td class="table-td hidden whitespace-nowrap md:table-cell">
                                                    {{ $row->created_at?->format('d M Y') }}
                                                </td>
                                                <td class="table-td">
                                                    <div class="flex items-center justify-end gap-1">
                                                        <a href="{{ url('/dashboard') }}?tab=categories&edit={{ $row->id }}"
                                                            class="btn btn-ghost btn-sm text-indigo-600 hover:bg-indigo-50 hover:text-indigo-700">
                                                            Edit
                                                        </a>
                                                        <form method="POST" action="{{ url('/categories/' . $row->id) }}"
                                                            onsubmit="return confirm('Hapus kategori {{ $row->name }}?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="from" value="dashboard">
                                                            <button type="submit"
                                                                class="btn btn-ghost btn-sm text-rose-600 hover:bg-rose-50 hover:text-rose-700">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if ($categories->hasPages())
                                <div class="border-t border-slate-200 px-5 py-4 sm:px-6">
                                    {{ $categories->links() }}
                                </div>
                            @endif
                        @endif
                    </section>

                    <aside>
                        <form action="{{ $categoryAction }}" method="POST" class="card p-5 sm:p-6">
                            @csrf
                            @if ($editCategory)
                                @method('PUT')
                            @endif
                            <input type="hidden" name="from" value="dashboard">
                            <input type="hidden" name="_form" value="categories">

                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <h2 class="text-base font-semibold text-slate-900">
                                        {{ $editCategory ? 'Edit kategori' : 'Tambah kategori' }}
                                    </h2>
                                    <p class="text-xs text-slate-500">
                                        {{ $editCategory ? 'Perbarui data kategori terpilih.' : 'Simpan kategori baru langsung ke database.' }}
                                    </p>
                                </div>
                                @if ($editCategory)
                                    <a href="{{ url('/dashboard') }}?tab=categories" class="btn btn-secondary btn-sm">Batal</a>
                                @endif
                            </div>

                            <div class="mt-5">
                                <label for="category-name" class="label">Nama kategori</label>
                                <input type="text" id="category-name" name="name"
                                    value="{{ old('name', $editCategory->name ?? '') }}" required
                                    placeholder="Contoh: Teknologi" class="input">
                                @error('name')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label for="category-description" class="label">Deskripsi</label>
                                <textarea id="category-description" name="description" rows="3"
                                    placeholder="Penjelasan singkat kategori"
                                    class="input resize-none">{{ old('description', $editCategory->description ?? '') }}</textarea>
                                @error('description')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-5 w-full">
                                {{ $editCategory ? 'Simpan perubahan' : 'Tambah kategori' }}
                            </button>
                        </form>
                    </aside>
                </div>
            </div>

            <div data-crud-panel="posts" class="{{ $currentTab === 'posts' ? '' : 'hidden' }}">
                <div class="grid gap-6 xl:grid-cols-[1.5fr_1fr]">
                    <section class="card overflow-hidden">
                        <div class="border-b border-slate-200 p-5 sm:p-6">
                            <div class="flex items-center justify-between gap-4">
                                <div>
                                    <h2 class="text-base font-semibold text-slate-900">Daftar post</h2>
                                    <p class="mt-0.5 text-sm text-slate-500">{{ $posts->total() }} post terdaftar.</p>
                                </div>
                                <span class="badge badge-emerald">{{ $posts->total() }} data</span>
                            </div>

                            <form method="GET" action="{{ url('/dashboard') }}" class="mt-4 flex gap-2">
                                <input type="hidden" name="tab" value="posts">
                                <input type="search" name="q" value="{{ $search }}" placeholder="Cari judul atau isi post..."
                                    class="input flex-1">
                                <button type="submit" class="btn btn-primary">Cari</button>
                                @if ($search !== '')
                                    <a href="{{ url('/dashboard') }}?tab=posts" class="btn btn-secondary">Reset</a>
                                @endif
                            </form>
                        </div>

                        @if ($posts->isEmpty())
                            <div class="px-6 py-12 text-center">
                                <p class="text-sm font-semibold text-slate-700">Belum ada post.</p>
                                <p class="mt-1 text-sm text-slate-500">Tulis post pertama melalui form di samping.</p>
                            </div>
                        @else
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-slate-200">
                                    <thead class="bg-slate-50">
                                        <tr>
                                            <th class="table-th">Post</th>
                                            <th class="table-th hidden md:table-cell">Dibuat</th>
                                            <th class="table-th text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-100">
                                        @foreach ($posts as $row)
                                            <tr class="transition hover:bg-slate-50/70">
                                                <td class="table-td">
                                                    <p class="font-semibold text-slate-800">{{ $row->title }}</p>
                                                    <p class="mt-0.5 line-clamp-2 max-w-md text-xs leading-relaxed text-slate-500">
                                                        {{ $row->body }}
                                                    </p>
                                                </td>
                                                <td class="table-td hidden whitespace-nowrap md:table-cell">
                                                    {{ $row->created_at?->format('d M Y') }}
                                                </td>
                                                <td class="table-td">
                                                    <div class="flex items-center justify-end gap-1">
                                                        <a href="{{ url('/dashboard') }}?tab=posts&edit={{ $row->id }}"
                                                            class="btn btn-ghost btn-sm text-indigo-600 hover:bg-indigo-50 hover:text-indigo-700">
                                                            Edit
                                                        </a>
                                                        <form method="POST" action="{{ url('/posts/' . $row->id) }}"
                                                            onsubmit="return confirm('Hapus post {{ $row->title }}?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <input type="hidden" name="from" value="dashboard">
                                                            <button type="submit"
                                                                class="btn btn-ghost btn-sm text-rose-600 hover:bg-rose-50 hover:text-rose-700">
                                                                Hapus
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            @if ($posts->hasPages())
                                <div class="border-t border-slate-200 px-5 py-4 sm:px-6">
                                    {{ $posts->links() }}
                                </div>
                            @endif
                        @endif
                    </section>

                    <aside>
                        <form action="{{ $postAction }}" method="POST" class="card p-5 sm:p-6">
                            @csrf
                            @if ($editPost)
                                @method('PUT')
                            @endif
                            <input type="hidden" name="from" value="dashboard">
                            <input type="hidden" name="_form" value="posts">

                            <div class="flex items-center justify-between gap-3">
                                <div>
                                    <h2 class="text-base font-semibold text-slate-900">
                                        {{ $editPost ? 'Edit post' : 'Tambah post' }}
                                    </h2>
                                    <p class="text-xs text-slate-500">
                                        {{ $editPost ? 'Perbarui post terpilih.' : 'Tulis post baru langsung dari dashboard.' }}
                                    </p>
                                </div>
                                @if ($editPost)
                                    <a href="{{ url('/dashboard') }}?tab=posts" class="btn btn-secondary btn-sm">Batal</a>
                                @endif
                            </div>

                            <div class="mt-5">
                                <label for="post-title" class="label">Judul</label>
                                <input type="text" id="post-title" name="title"
                                    value="{{ old('title', $editPost->title ?? '') }}" required
                                    placeholder="Judul post" class="input">
                                @error('title')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-4">
                                <label for="post-body" class="label">Isi</label>
                                <textarea id="post-body" name="body" rows="6" required
                                    placeholder="Tulis isi post..."
                                    class="input resize-none">{{ old('body', $editPost->body ?? '') }}</textarea>
                                @error('body')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-5 w-full">
                                {{ $editPost ? 'Simpan perubahan' : 'Tambah post' }}
                            </button>
                        </form>
                    </aside>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script>
            (function () {
                const tabs = document.querySelectorAll('[data-crud-tab]');
                const panels = document.querySelectorAll('[data-crud-panel]');
                const description = document.getElementById('crud-tab-description');

                const activate = (name) => {
                    tabs.forEach((tab) => {
                        const active = tab.dataset.crudTab === name;
                        tab.classList.toggle('bg-white', active);
                        tab.classList.toggle('text-indigo-700', active);
                        tab.classList.toggle('shadow-sm', active);
                        tab.classList.toggle('text-slate-500', !active);
                        tab.classList.toggle('hover:text-slate-800', !active);
                        tab.setAttribute('aria-selected', active ? 'true' : 'false');

                        if (active && description) {
                            description.textContent = tab.dataset.description;
                        }
                    });

                    panels.forEach((panel) => {
                        panel.classList.toggle('hidden', panel.dataset.crudPanel !== name);
                    });

                    const url = new URL(window.location.href);
                    url.searchParams.set('tab', name);
                    url.searchParams.delete('edit');
                    window.history.replaceState({}, '', url);
                };

                tabs.forEach((tab) => {
                    tab.addEventListener('click', (event) => {
                        event.preventDefault();
                        activate(tab.dataset.crudTab);
                    });
                });
            })();
        </script>
    @endpush
</x-app-layout>
