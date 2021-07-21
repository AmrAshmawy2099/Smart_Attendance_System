@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="padding-top: 50px;">
        <div class="justify-content-center">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h3 class="mr-auto p-3">{{ __('Edit cards') }}</h3>

                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('cards.update', $card) }}" method="POST">
                        <div class="form-group row">
                            <label for="user_id" class="col-md-2 col-form-label text-md-right">User Code:</label>
                            <div class="col-md-6">
                                <input id="user_code" type="text"
                                    class="form-control @error('user_code') is-invalid @enderror" name="user_code"
                                    value="{{ $card->user_code }}" autofocus>
                                @error('user_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>

                        <div class="form-group row">
                            <label for="serial_no" class="col-md-2 col-form-label text-md-right">Serial Number</label>
                            <div class="col-md-6">
                                <input id="serial_no" type="text"
                                    class="form-control @error('serial_no') is-invalid @enderror" name="serial_no"
                                    value="{{ $card->serial_no }}">
                                @error('serial_no')
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
                                    value="{{ $card->certificate }}">
                                @error('certificate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="type" class="col-md-2 col-form-label text-md-right">Type</label>
                            <div class="col-md-6">
                                <select class="custom-select" id="type" name="type">

                                    <option value="Smart Card">Smart Card</option>
                                    <option value="Mobile">Mobile</option>
                                    <option value="Normal Card">Normal Card</option>
                                </select>

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="valid" class="col-md-2 col-form-label text-md-right">Validity</label>
                            <div class="col-1 mr-auto col-form-label ">
                                <div class="form-check form-check-inline mr-10">
                                    <input type="hidden" class="form-check-input" name="valid" value="0" />
                                    <input type="checkbox" class="form-check-input" name="valid" value="1" @if ($card->valid == 1) checked @endif />
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
