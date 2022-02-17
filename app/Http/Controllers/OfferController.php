<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\User;
use App\Models\Business;
use App\Models\Student;

use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $offers = DB::table('offers')->paginate(15);
        return view('offer.index',["offers" => $offers, "users" => User::all(), "businesses" => Business::all()]);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('offer.create',['users' => User::all()]);
    } 

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $business_id = Business::where('user_id', '=', $request->user_id)->get('id','name');
        $offer = Offer::create($request->except('_token','user_id'));
        foreach ($business_id as $business) {
            $id = $business->id;
            $affectedRows = Offer::where('id', '=', $offer->id)->update(['business_id' => $id]);
        }
        
        return redirect(route('offer.index'))->withSuccess('Se ha creado la vacante con éxito!');;
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
        return view('offer.edit', ['offer' => Offer::find($id), 'users'=> User::all(), 'students'=> Student::all(), 'offers' => Offer::all()]);
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
        $offer = Offer::findOrFail($id);

        $offer->update($request->except('_token','student_id'));
        $data = ['name' => $request->offer_id];
        $offer->update($data);

        $student = Student::findOrFail($request->student_id);
        $student->offer_id = $id;
        $student->save();
        
        return redirect(route('offer.index'))->withSuccess('La vacante ha sido modificada con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $success = Offer::destroy($id);
        return redirect(route('offer.index'))->withSuccess('La vacante ha sido eliminada con éxito');
    }
}
