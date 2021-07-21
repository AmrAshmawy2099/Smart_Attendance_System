@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="padding-top: 50px;">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3 class="mr-auto p-3">Add Machine</h3>

                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('machines.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="serial_no">Serial Number:</label>
                            <input type="text" class="form-control @error('serial_no') is-invalid @enderror"
                                name="serial_no" />
                            @error('serial_no')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="room_id">Room ID:</label>
                            <input type="text" class="form-control @error('room_id') is-invalid @enderror" name="room_id" />
                            @error('room_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="certificate">Certificate:</label>
                            <input type="text" class="form-control" name="certificate" />
                        </div>

                        <button class="btn btn-block  btn-outline-primary active" type="submit" aria-pressed="true">
                            Submit
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
