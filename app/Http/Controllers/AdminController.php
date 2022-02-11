<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function create(Request $request){
        $user = User::create($request->except('_token'));

        return redirect(route('home'))->withSuccess('Se ha registrado con éxito!');
    }
}
