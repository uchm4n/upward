@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    @auth
                        <div class="card-header">{{ __('Dashboard') }}</div>
                    @else
                        <div class="card-header">{{ __('Guest Table') }}</div>
                    @endauth

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif


                        <u-table :auth="{{$auth}}"></u-table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
