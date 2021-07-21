@extends('layouts.app')

@section('content')
<div class = "container-fluid" style="padding-top: 50px;">
    <div class="justify-content-center">
            <div class="card">

                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3 class="mr-auto p-3">Cards</h3>
                        <div class="btn-group" role="group">
                            <a href="{{ route('cards.create') }}">
                                <button type="button" class="btn btn-primary">Add card</button></a>
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
                                <th scope="col" class="text-center">Type</th>
                                <th scope="col" class="text-center">User</th>
                                <th scope="col" class="text-center">Certificate</th>
                                <th scope="col" class="text-center">Validity</th>
                                <th scope="col" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cards as $card)

                            <tr>
                                <td scope="row" class="text-center">
                                    {{$card->id}}
                                </td>
                                <td class="text-center">
                                    {{$card->serial_no}}
                                </td >
                                <td class="text-center">
                                    {{$card->type}}
                                </td >
                                <td class="text-center">
                                    {{$card->user()->get()->pluck('name')->first()}}
                                </td>
                                <td class="text-center">
                                    {{$card ->certificate}}
                                </td>
                                <td class="text-center">

                                    {{-- {{$card ->valid}} --}}
                                    @if ($card ->valid == 1)
                                    <span class="badge badge-success">{{" "}}</span>
                                    @elseif ($card ->valid == 0)
                                    <span class="badge badge-danger">{{" "}}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <div class="btn-group" role="group" aria-label="Basic example">

                                        <a href="{{ route ('cards.edit', $card->id)}}"><button
                                                class="btn btn-block  btn-outline-primary active" type="button"
                                                aria-pressed="true">Edit</button></a>

                                        <form action="{{ route('cards.destroy',$card) }}" method="POST">
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
                    {{$cards->links()}}
                </div>
            </div>
    </div>
</div>
@endsection
