<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // READ & SEARCH (Poin 3a - Read)
    public function index()
{
    $users = \App\Models\User::where('role', 'pelanggan')->get();

    return view('admin.Pelanggan.index', compact('users'));
}

    // CREATE (Poin 3a - Create)
    public function store(Request $request) {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('password123'), // password default
            'alamat' => $request->alamat,
            'no_telepon' => $request->no_telepon,
            'role' => 'pelanggan',
            'status_pelanggan' => 'aktif'
        ]);
        return redirect()->back()->with('success', 'Pelanggan berhasil ditambah!');
    }

    // UPDATE (Poin 3a - Update)
    public function update(Request $request, $id) {
        $user = User::find($id);
        $user->update($request->all());
        return redirect()->back()->with('success', 'Data pelanggan diperbarui!');
    }

    // DELETE (Poin 3a - Delete)
    public function destroy($id) {
        User::find($id)->delete();
        return redirect()->back()->with('success', 'Pelanggan berhasil dihapus!');
    }
}