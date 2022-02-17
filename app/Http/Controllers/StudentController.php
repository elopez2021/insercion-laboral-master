<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    public function getDownload(Request $request)
    {
        return Storage::download($request->cv_path);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('student.index', ['users'=> User::all(), 'students' => Student::paginate(15)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.signin', ['users'=> User::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->role = 1;
        $user->save(); // Create user retrieving the info from request.

        // Saving the id of the user
        $userID = User::where('email', '=', $request->email);
        
        // Storing Curriculum Vitae and saving the path into the variable
        $cv_path = $request->file('cv_path')->store('cv');

        // Storing the student
        $student = Student::create($request->except('_token','email','cv_path','password'));
        
        $affectedRows = Student::where('identification', '=', $request->identification)->update(['cv_path' => $cv_path]);
        $affectedRows = Student::where('identification', '=', $request->identification)->update(['user_id' => $user->id]);

        return redirect(route('student.index'))->withSuccess('Se ha registrado con éxito!');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $success = Student::destroy($id);       
        return redirect(route('student.index'))->withSuccess('El estudiante ha sido eliminado con éxito');
    }
}
