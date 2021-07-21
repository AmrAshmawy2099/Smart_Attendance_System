@extends('layouts.app')

@section('content')
<div class = "container-fluid" style="padding-top: 50px;">
    <div class="justify-content-center">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3 class="mr-auto p-3">Records</h3>
                        <div class="btn-group" role="group">
                            {{-- <a href="{{ route('records.delete')}}" method="POST">
                                <button type="submit" class="btn btn-outline-danger active">Delete All Records</button>
                            </a> --}}
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-responsive-sm table-hover table-striped table-outline mb-0">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center">User Code</th>
                                <th class="text-center">Room Name</th>
                                <th class="text-center">Machine ID</th>
                                <th class="text-center">Card ID</th>
                                <th class="text-center">Uploaded By</th>
                                <th class="text-center">Body</th>
                                <th class="text-center">Date</th>


                            </tr>
                        </thead>

                        <tbody>
                            @foreach($records as $record)

                            <tr>
                                <td scope="row" class="text-center">
                                    {{$record->user_code}}
                                </td>

                                <td class="text-center">
                                    {{DB::table('rooms')->where('id',$record->room_id)->get()->pluck('name')->first()}}
                                </td>
                                <td class="text-center">
                                    {{$record ->machine_id}}
                                </td>
                                <td class="text-center">
                                    {{$record->card_id}}
                                </td>
                                <td class="text-center">
                                    {{$record->uploaded_by}}
                                </td>
                                <td class="text-center">
                                    {{$record->body}}
                                </td>
                                <td class="text-center">
                                    {{$record->created_at}}
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                    {{$records->links()}}
                </div>
            </div>
    </div>
</div>
@endsection
