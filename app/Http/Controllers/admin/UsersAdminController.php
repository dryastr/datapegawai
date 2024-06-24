<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Region;
use Illuminate\Support\Facades\DB;

class UsersAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('region')->where('role_id', 2)->get();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Generate unique code
        $users_uniq_code = $this->generateUniqueCode();

        // Retrieve regions for select options
        $regions = Region::all();

        return view('admin.users.create', compact('users_uniq_code', 'regions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'telegram_id' => 'nullable',
            'region_id' => 'required',
            'password' => 'required|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->telegram_id = $request->telegram_id;
        $user->region_id = $request->region_id;
        $user->password = bcrypt($request->password);

        $user->role_id = 2;
        $user->users_uniq_code = $this->generateUniqueCode();
        $user->save();

        return redirect()->route('users.index')->with('success', 'Pengguna baru berhasil ditambahkan.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $regions = Region::all();
        return view('admin.users.edit', compact('user', 'regions'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'telegram_id' => 'nullable',
            'region_id' => 'required',
            'password' => 'nullable|min:8',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->telegram_id = $request->telegram_id;
        $user->region_id = $request->region_id;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
    }

    private function generateUniqueCode()
    {
        $lastUserCode = User::max('users_uniq_code');

        if ($lastUserCode) {
            $lastNumber = substr($lastUserCode, 4);
            $newNumber = intval($lastNumber) + 1;
            $newUserCode = 'IDKR' . str_pad($newNumber, 5, '0', STR_PAD_LEFT);
        } else {
            $newUserCode = 'IDKR00001';
        }

        return $newUserCode;
    }
}
