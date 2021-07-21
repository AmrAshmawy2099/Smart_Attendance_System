@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-around" style="padding-top: 50px;">
            <div class="card border-primary mb-3" style="max-width: 18rem;">
                <div class="card-body text-primary">
                  <h5 class="card-title">Machines Count</h5>
                  <p class="card-text">{{DB::table('machines')->count()}}</p>
                </div>
              </div>
              <div class="card border-success mb-3" style="max-width: 18rem;">
                <div class="card-body text-success">
                  <h5 class="card-title">Rooms Count</h5>
                  <p class="card-text">{{DB::table('rooms')->count()}}</p>
                </div>
              </div>
              <div class="card border-danger mb-3" style="max-width: 18rem;">
                <div class="card-body text-danger">
                  <h5 class="card-title">Records in the last 24 hours</h5>
                  <p class="card-text">{{DB::table('records')->where('created_at', '>=', Carbon\Carbon::now()->subDay()->toDateTimeString())->count()}}</p>
            </div>
            {{-- <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif



                    {{ __('Hello') }}
                </div>
            </div> --}}
        </div>
    </div>
</div>
@endsection
