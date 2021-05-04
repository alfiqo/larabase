<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    protected $perPage;

    public function __construct()
    {
        $this->middleware(['permission:create users|edit users|delete users']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->perPage = (int) config('custom.perPage');

        $users = User::with('roles')->latest()->paginate($this->perPage);
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|min:7'
        ]);

        $data = $request->except('password');
        $data['password'] = Hash::make($request->input('password'));

        try {
            DB::beginTransaction();
            User::create($data);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            \Log::error($exception);

            return redirect()->back()->with(['message' => 'Gagal menambahkan user', 'alert' => 'danger']);
        }

        return redirect()->route('users.index')->with([
            'status' => 'User telah berhasil disimpan',
            'alert' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.create', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($user->id, 'id')]
        ]);

        $data = $request->except('password');

        if ($request->input('password')) {
            $request->validate([
                'password' => 'required|min:7'
            ]);
            $data['password'] = Hash::make($request->input('password'));

        } elseif (!$request->input('password')) {
            $request->request->remove('password');
        }


        try {
            DB::beginTransaction();
            $user->update($data);
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollback();
            \Log::error($exception);

            return redirect()->back()->with(['message' => $exception->getMessage(), 'alert' => 'danger']);
        }

        return redirect()->route('users.index')->with([
            'status' => 'User telah berhasil diupdate',
            'alert' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with([
            'status' => 'User telah berhasil dihapus',
            'alert' => 'danger'
        ]);
    }
}
