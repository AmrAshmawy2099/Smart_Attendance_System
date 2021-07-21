@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="padding-top: 50px;">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3 class="mr-auto p-3">{{ __('Add Room') }}</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('rooms.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" />
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="building">Building:</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="building" />
                            @error('building')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="floor">floor:</label>
                            <input type="text" class="form-control @error('floor') is-invalid @enderror" name="floor" />
                            @error('floor')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
