@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="padding-top: 50px;">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3 class="mr-auto p-3">{{ __('Add Card') }}</h3>

                    </div>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('cards.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="user_code">User Code:</label>
                            <input type="text" class="form-control @error('user_code') is-invalid @enderror"
                                name="user_code" />
                            @error('user_code')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

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
                            <label for="certificate">Certificate:</label>
                            <input type="text" class="form-control  @error('certificate') is-invalid @enderror"
                                name="certificate" />
                            @error('certificate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror


                        </div>


                        <div class="form-group">
                            <label for="type">Type:</label>
                            <select class="custom-select" id="type" name="type">
                                <option selected>Smart Card</option>
                                <option value="1">Mobile</option>
                                <option value="2">Normal Card</option>
                            </select>
                        </div>

                        <div class="form-group row justify-content-start">

                            <label class="col-md-2 col-form-label " for="valid">Validity:</label>

                            <div class="col-1 mr-auto col-form-label ">
                                <div class="form-check form-check-inline mr-10">
                                    <input type="hidden" class="form-check-input" name="valid" value="0" />
                                    <input type="checkbox" class="form-check-input" name="valid" value="1" />

                                </div>
                            </div>



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
