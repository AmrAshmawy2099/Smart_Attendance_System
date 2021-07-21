@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="padding-top: 50px;">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3 class="mr-auto p-3">Rooms</h3>
                        <div class="btn-group" role="group">
                            <a href="{{ route('rooms.create') }}">
                                <button type="button" class="btn btn-primary">Add Room</button></a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-responsive-sm table-hover table-outline mb-0 table-striped">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">
                                    ID
                                </th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Building</th>
                                <th class="text-center">Floor</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rooms as $room)
                                <tr>
                                    <td class="text-center">
                                        {{ $room->id }}

                                    </td>
                                    <td class="text-center">
                                        {{ $room->name }}
                                    </td>
                                    <td class="text-center">
                                        {{ $room->building }}
                                    </td>
                                    <td class="text-center">
                                        {{ $room->floor }}
                                    </td>
                                    <td class="text-center">

                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <a href="{{ route('rooms.records', $room) }}"><button
                                                    class="btn btn-block  btn-outline-success active" type="button"
                                                    aria-pressed="true">Records</button></a>
                                            <a href="{{ route('rooms.edit', $room->id) }}"><button
                                                    class="btn btn-block  btn-outline-primary active" type="button"
                                                    aria-pressed="true">Edit</button></a>
                                            <form action="{{ route('rooms.destroy', $room) }}" method="POST">
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
                    {{ $rooms->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
