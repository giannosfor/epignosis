@extends('layouts.app')


@section('content')

    <div class="row">

        <div class="col-lg-12 margin-tb">

            <div class="pull-left">

                <h2> Show Leave</h2>

            </div>

            <div class="pull-right">

                <a class="btn btn-primary" href="{{ route('leaves.index') }}"> Back</a>

            </div>

        </div>

    </div>


    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Name:</strong>

                {{ $leave->name }}

            </div>

        </div>

        <div class="col-xs-12 col-sm-12 col-md-12">

            <div class="form-group">

                <strong>Details:</strong>

                {{ $leave->detail }}

            </div>

        </div>

    </div>

@endsection

<p class="text-center text-primary"><small>Epignosis</small></p>