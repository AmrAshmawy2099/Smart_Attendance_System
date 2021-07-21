@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="padding-top: 50px;">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3 class="mr-auto p-3">Users</h3>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-responsive-sm table-hover table-outline mb-0 table-striped ">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Email</th>
                                <th class="text-center">Code</th>
                                <th class="text-center">Roles</th>
                                <th class="text-center">Actions</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td class="text-center">
                                        {{ $user->id }}
                                    </td>
                                    <td class="text-center">
                                        {{ $user->name }}
                                    </td>
                                    <td class="text-center">
                                        {{ $user->email }}
                                    </td>
                                    <td class="text-center">
                                        {{ $user->code }}
                                    </td>
                                    <td class="text-center">
                                        {{ implode(
    ',',
    $user->roles()->get()->pluck('name')->toArray(),
) }}
                                    </td>
                                    <td class="text-center">



                                        <div class="btn-group" role="group" aria-label="Basic example">

                                            <a href="{{ route('admin.users.edit', $user->id) }}"><button
                                                    class="btn btn-block  btn-outline-primary active" type="button"
                                                    aria-pressed="true">Edit</button></a>

                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST">
                                                @csrf
                                                {{ method_field('Delete') }}
                                                @can('delete-users')
                                                    @if (Auth::user()->id != $user->id)
                                                        <button class="btn btn-block  btn-outline-danger active" type="submit"
                                                            aria-pressed="true">Delete</button>
                                                    @endif
                                                @endcan
                                            </form>

                                        </div>
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
