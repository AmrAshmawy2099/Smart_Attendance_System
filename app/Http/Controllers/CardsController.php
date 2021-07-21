<?php

namespace App\Http\Controllers;
use Gate;
use App\Card;
use App\User;
use Illuminate\Http\Request;

class CardsController extends Controller
{
    public function index()
    {
        $users = User::all();
        $cards = card::paginate(10);
        return view('cards.index')->with([
            'users' => $users,
            'cards' => $cards
        ]);

    }

    public function create()
    {
        return view('cards.create');
    }

    public function store(Request $request)
    {
        $this->validate($request,array(
            'user_code'=>'required | exists:users,code,deleted_at,NULL',
            'serial_no'=>'required|size:5|unique:cards,serial_no',
            'certificate'=>'required | unique:cards,certificate'
        ),
    );
        $card = new card;
        $card->serial_no=$request->serial_no;
        $card->type=$request->type;
        $card->valid=$request->valid;
        $card->user_code=$request->user_code;
        $card->certificate=$request->certificate;
        $card->save();
        $user = User::where('code',$request->user_code)->first();
        $card->user()->associate($user);

        return redirect()->route('cards.index');
    }

    public function destroy($id)
    {
        if(Gate::denies('delete-users')){
            return redirect(route('card.index'));
        }
        $card = card::find($id);
        $card->delete();
        return redirect()->route('cards.index');
    }
    public function edit(card $card)
    {
        if(Gate::denies('Manage-users')){
            return redirect(route('card.index'));
        }
        return view('cards.edit')->with('card', $card);
    }

    public function update(Request $request, card $card)
    {
        $this->validate($request,array(
            'serial_no'=>'required|size:5|unique:cards,serial_no,'.$card->id,
            'user_code'=>'required | exists:users,code,deleted_at,NULL',
            'certificate'=>'required | unique:cards,certificate,'.$card->id,
        ));
        $card->serial_no=$request->serial_no;
        $card->type=$request->type;
        $card->valid=$request->valid;
        $card->user_code=$request->user_code;
        $card->certificate=$request->certificate;
        $card->save();
        return redirect()->route('cards.index');
    }
}
