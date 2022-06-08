<?php

namespace App\Http\Controllers\backoffice;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('roles')->with('warehouse')->paginate(env('TABLE_PAGINATE'));

        return view('backoffice.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouses = Warehouse::all();

        return view('backoffice.users.create', compact('warehouses'));
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
            'email' => 'required|email:rfc,dns|unique:users,email|same:emailConfirmation',
            'emailConfirmation' => 'required|email:rfc,dns',
            'warehouse_id' => 'required|numeric|exists:warehouses,id',
        ]);

        $formRequest = array_merge(
            $request->all(), 
            [
                'password' => Hash::make($request->email),
                'status' => 'active',
            ]
        );

        unset($formRequest['emailConfirmation']);

        $admin = User::create($formRequest);
        $admin->assignRole('admin');

        return redirect()->route('users.create')->with('success','Data successfully saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $warehouses = Warehouse::all();

        return view('backoffice.users.edit', compact('user', 'warehouses'));
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
            'email' => 'required|email:rfc,dns|unique:users,email,'.$user->id.'|same:emailConfirmation',
            'emailConfirmation' => 'required|email:rfc,dns',
            'warehouse_id' => 'required|numeric|exists:warehouses,id',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'warehouse_id' => $request->warehouse_id,
        ]);

        return redirect()->route('users.edit', $user->id)->with('success','Data successfully saved');
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

        return redirect()->route('users')->with('success','Data successfully deleted');
    }
}
