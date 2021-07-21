<?php

namespace App\Http\Controllers;
use Gate;
use Illuminate\Http\Request;
use App\Machine;
use App\Room;
use App\Records;


class MachinesController extends Controller
{

    public function index()
    {
        $machines = machine::paginate(10);
        return view('machines.index')->with('machines', $machines);

    }

    public function create()
    {
        return view('machines.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'serial_no'    =>  'required|unique:machines,serial_no,',
            'room_id'     =>  'integer |nullable | exists:rooms,id,deleted_at,NULL',
            'certificate' =>  'nullable',
        ]);
        $machine = new machine;
        $machine->serial_no=$request->serial_no;
        $machine->room_id=$request->room_id;
        $machine->certificate=$request->certificate;
        $machine->save();
        return redirect()->route('machines.index');
    }

    public function destroy($id)
    {
        if(Gate::denies('delete-users')){
            return redirect(route('machine.index'));
        }
        $machine = machine::find($id);
        $machine->delete();
        return redirect()->route('machines.index');
    }
    public function edit(machine $machine)
    {
        if(Gate::denies('Manage-users')){
            return redirect(route('machine.index'));
        }
        return view('machines.edit')->with('machine', $machine);
    }

    public function records(machine $machine)
    {
        return view('admin.users.records')->with(
            'records', Records::where('machine_id',$machine->id)->latest()->paginate(10)
        );
    }
    public function update(Request $request, machine $machine)
    {
        $this->validate($request, [
            'serial_no'    =>  'required|unique:machines,serial_no,'.$machine->id,
            'room_id'     =>  'integer | nullable | exists:rooms,id,deleted_at,NULL',
            'certificate' =>  'nullable',
        ]);
        $machine->serial_no=$request->serial_no;
        $machine->room_id=$request->room_id;
        $machine->certificate=$request->certificate;
        $machine->save();
        return redirect()->route('machines.index');
    }
}
