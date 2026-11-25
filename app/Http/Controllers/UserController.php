<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Tampilkan semua user (Bagian 5) dengan pencarian dan filter role.
     */
    public function index(Request $request)
    {
        $filters = $request->validate([
            'q' => ['nullable', 'string', 'max:100'],
            'role' => ['nullable', 'in:user,admin'],
        ]);

        $users = User::query()
            ->when($filters['q'] ?? null, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('alamat', 'like', "%{$search}%");
                });
            })
            ->when($filters['role'] ?? null, fn ($query, $role) => $query->where('role', $role))
            ->latest()
            ->paginate(8)
            ->withQueryString();

        $summary = [
            'total' => User::count(),
            'admins' => User::where('role', 'admin')->count(),
            'regular_users' => User::where('role', 'user')->count(),
        ];

        return view('user.index', compact('users', 'summary'));
    }

    /**
     * Tampilkan form pembuatan user (Bagian 4).
     */
    public function show()
    {
        return view('user.create');
    }

    /**
     * Simpan user baru dengan validasi (Bagian 4 + Latihan).
     */
    public function store(Request $request)
    {
        // Validasi: nama hanya huruf (tanpa angka) sesuai Latihan Bagian 4 no 1
        $request->validate([
            'name' => ['required', 'min:3', 'max:50', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:6'],
            'alamat' => ['nullable', 'string'],
            'tanggal_lahir' => ['nullable', 'date'],
            'role' => ['nullable', 'string', 'in:user,admin'],
        ], [
            'name.regex' => 'Kolom nama hanya boleh berisi huruf dan spasi.',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'alamat' => $request->alamat,
            'tanggal_lahir' => $request->tanggal_lahir,
            'role' => $request->role ?? 'user',
        ]);

        return $this->redirectAfter($request, 'Data user berhasil disimpan.');
    }

    /**
     * Tampilkan form edit user (Bagian 5).
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('user.edit', compact('user'));
    }

    /**
     * Proses update user (Bagian 5 + Latihan).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'min:3', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => ['required', 'email', 'unique:users,email,' . $id],
            'password' => ['nullable', 'min:6'],
            'alamat' => ['nullable', 'string'],
            'tanggal_lahir' => ['nullable', 'date'],
            'role' => ['nullable', 'string', 'in:user,admin'],
        ], [
            'name.regex' => 'Kolom nama hanya boleh berisi huruf dan spasi.',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->alamat = $request->alamat;
        $user->tanggal_lahir = $request->tanggal_lahir;

        if ($request->filled('role')) {
            $user->role = $request->role;
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return $this->redirectAfter($request, 'User berhasil diupdate.');
    }

    /**
     * Hapus user (Bagian 5).
     */
    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if (auth()->id() === $user->id) {
            return $this->redirectAfter($request, 'Anda tidak dapat menghapus akun sendiri.', 'error');
        }

        $user->delete();

        return $this->redirectAfter($request, 'User berhasil dihapus.');
    }

    private function redirectAfter(Request $request, string $message, string $type = 'success')
    {
        $url = $request->input('from') === 'dashboard'
            ? url('/dashboard') . '?tab=users'
            : url('/users');

        return redirect($url)->with($type, $message);
    }
}
