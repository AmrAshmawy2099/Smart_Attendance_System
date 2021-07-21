@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="padding-top: 50px;">
        <div class="justify-content-center">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3 class="mr-auto p-3">Machines</h3>
                        <div class="btn-group" role="group">
                            <a href="{{ route('machines.create') }}">
                                <button type="button" class="btn btn-primary">Add Machine</button></a>
                        </div>
                    </div>
                </div>


                <div class="card-body">
                    <table class="table table-responsive-sm table-hover table-outline mb-0 table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="text-center">
                                    ID
                                </th>
                                <th scope="col" class="text-center">Serial Number</th>
                                <th scope="col" class="text-center">Room ID</th>
                                <th scope="col" class="text-center">Certificate</th>
                                <th scope="col" class="text-center">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($machines as $machine)

                                <tr>
                                    <td class="text-center">
                                        {{ $machine->id }}

                                    </td>
                                    {{-- <td scope="row" class="text-center">
                                    {{$machine->id}}
                                </td> --}}
                                    <td class="text-center">
                                        {{ $machine->serial_no }}
                                    </td>
                                    <td class="text-center">
                                        {{ $machine->room_id }}
                                    </td>
                                    <td class="text-center">
                                        {{ $machine->certificate }}
                                    </td>

                                    <td class="text-center">

                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('machines.records', $machine) }}"><button
                                                    class="btn btn-block  btn-outline-success active" type="button"
                                                    aria-pressed="true">Records</button></a>
                                            <a href="{{ route('machines.edit', $machine->id) }}"><button
                                                    class="btn btn-block  btn-outline-primary active" type="button"
                                                    aria-pressed="true">Edit</button></a>

                                            <form action="{{ route('machines.destroy', $machine) }}" method="POST">
                                                @csrf
                                                {{ method_field('Delete') }}
                                                @can('delete-users')
                                                    <button class="btn btn-block  btn-outline-danger active" type="submit"
                                                        aria-pressed="true">Delete</button>
                                                @endcan
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $machines->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
