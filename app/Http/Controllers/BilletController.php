<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth;
use App\Billet;
use App\BilletOrder;
use App\User;

class BilletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $post = Billet::latest()->paginate(5);

        return view('billet.index', compact('post'))
                        ->with('i', (request()->input('page',1) - 1) *5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {



       // 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $decreasePlaces = Billet::first();

        $count = $decreasePlaces->places -1;

        $data = array(
            'places' => $count 
        );

        $id = $request->traject_id;

        Billet::whereId($id)->update($data);

        $form_data = array(
            'nom' => $request->nom, 
            'prenom' => $request->prenom, 
            'phone' => $request->phone, 
            'submit_by' => $request->submit_by, 
            'traject_id' => $request->traject_id

        );



       BilletOrder::insert($form_data);

       return view('merci')->with('success_message', 'Votre bille a bien ete reserver');

        
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {

        $search = DB::table('billets')
                    ->where('from', 'LIKE', '%'.$request->from.'%')
                    ->where('to', 'LIKE', '%'.$request->to.'%')
                    ->orWhere('date', 'LIKE', '%'.$request->date.'%')
                    ->get();
                    
        if ($search->count() === 0) {

             session()->flash('errors', collect(['Aucun resultat pour cette destination !!']));


            return view('billet.search',compact ( 'search'));
            // return redirect()->to('/')->with('error',$error)->with('search', $search);
        
        }else{
        
            return view('billet.search', compact('request', 'search'));
            // return redirect('home')->with('success_message', 'Aucun resultat pour cette destination !!');
        
        }

        
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data = Billet::findOrFail($id);

        return view('billet.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Billet::findOrFail($id);
        
        return view('billet/modify',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        // $result = Billet::findOrFail($id);
        
            dd($request->all());
        // return view('billet', compact('result'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Billet::findOrFail($id);
        $data->delete();
        return back();
    }
}
