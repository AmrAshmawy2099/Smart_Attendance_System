@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="padding-top: 50px;">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3 class="mr-auto p-3">{{ __('Edit Machines') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('machines.update', $machine) }}" method="POST">

                        <div class="form-group row">
                            <label for="serial_no" class="col-md-2 col-form-label text-md-right">Serial Number</label>
                            <div class="col-md-6">
                                <input id="serial_no" type="text"
                                    class="form-control @error('serial_no') is-invalid @enderror" name="serial_no"
                                    value="{{ $machine->serial_no }}" required autofocus>
                                @error('serial_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="room_id" class="col-md-2 col-form-label text-md-right">Room ID:</label>
                            <div class="col-md-6">
                                <input id="room_id" type="text" class="form-control @error('room_id') is-invalid @enderror"
                                    name="room_id" value="{{ $machine->room_id }}">
                                @error('room_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="certificate" class="col-md-2 col-form-label text-md-right">Certificate</label>
                            <div class="col-md-6">
                                <input id="certificate" type="text"
                                    class="form-control @error('certificate') is-invalid @enderror" name="certificate"
                                    value="{{ $machine->certificate }}">
                            </div>
                        </div>

                        @csrf
                        {{ method_field('PUT') }}


                        <button class="btn btn-block  btn-outline-primary active" type="submit" aria-pressed="true">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
