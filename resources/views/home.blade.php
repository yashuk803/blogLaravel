@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>

                    <div class="panel-body">
                        <?php $flush = session('message');?>

                        @if(\Session::has('message'))
                            <div class="alert alert-{{ $flush['status'] }}">
                                {{  $flush['message'] }}
                            </div>
                        @endif

                        @if($users->count()>0)

                            @foreach($users as $user)
                                {{$user->name}}
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
