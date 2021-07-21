@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="padding-top: 50px;">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3 class="mr-auto p-3">{{ __('Edit Rooms') }}</h3>

                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('rooms.update', $room) }}" method="POST">

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">Name</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                    name="name" value="{{ $room->name }}" autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">Building</label>
                            <div class="col-md-6">
                                <input id="building" type="text"
                                    class="form-control @error('building') is-invalid @enderror" name="building"
                                    value="{{ $room->building }}">
                                @error('building')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-2 col-form-label text-md-right">floor</label>
                            <div class="col-md-6">
                                <input id="floor" type="text" class="form-control @error('floor') is-invalid @enderror"
                                    name="floor" value="{{ $room->floor }}">
                                @error('floor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
