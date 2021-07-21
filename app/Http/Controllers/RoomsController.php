<?php

namespace App\Http\Controllers;
use Gate;
use Illuminate\Http\Request;
use App\Room;
use App\Records;
class RoomsController extends Controller
{
    public function index()
    {
        $rooms = room::paginate(10);
        return view('rooms.index')->with('rooms', $rooms);
    }
    public function create()
    {
        return view('rooms.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'    =>  'required|unique:rooms,name,',
            'floor'     =>  'integer|required',
            'building' =>  'integer|required',
        ]);
        $room = new room;
        $room->name=$request->name;
        $room->floor=$request->floor;
        $room->building=$request->building;

        $room->save();
        return redirect()->route('rooms.index');
    }

    public function destroy($id)
    {
        if(Gate::denies('delete-users')){
            return redirect(route('rooms.index'));
        }
        $room = room::find($id);
        $room->delete();
        return redirect()->route('rooms.index');
    }

    public function records(room $room)
    {
        return view('admin.users.records')->with(
            'records', Records::where('room_id',$room->id)->latest()->paginate(10)
        );
    }

    public function edit(room $room)
    {
        if(Gate::denies('Manage-users')){
            return redirect(route('rooms.index'));
        }
        return view('rooms.edit')->with('room', $room);
    }

    public function update(Request $request, room $room)
    {
        $this->validate($request, [
            'name'    =>  'required|unique:rooms,name,'.$room->id,
            'floor'     =>  'integer|required',
            'building' =>  'integer|required',
        ]);
        $room->name=$request->name;
        $room->floor=$request->floor;
        $room->building=$request->building;
        $room->save();

        return redirect()->route('rooms.index');
    }
}
