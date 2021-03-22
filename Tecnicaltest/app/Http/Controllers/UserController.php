<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\FromCollection;

class UserController extends Controller implements FromCollection
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::orderBy('id', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $params = $request->all();

        if ( $request->file ) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $params['avatar'] = $fileName;
            $request->file->move( public_path('storage'), $fileName );
        }

        $params['password'] = Hash::make($request->password);

        $user = User::create($params);

        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $params = $request->all();
        
        if ( $request->file ) {
            $fileName = time() . '_' . $request->file->getClientOriginalName();
            $params['avatar'] = $fileName;
            $request->file->move( public_path('storage'), $fileName );
        }

        if ( $request->password ) {
            $params['password'] = Hash::make($request->password);
        }

        $user->fill($params)->update();

        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }
}
