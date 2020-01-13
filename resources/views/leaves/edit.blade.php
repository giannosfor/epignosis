@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Leave</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('leaves.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('leaves.update',$leave->id) }}" method="POST">
    	@csrf
        @method('PUT')

         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Start:</strong>
                    <input type="date" name="vacation_start" value="{{ $leave->vacation_start }}" placeholder="dd/mm/yy">
                    <strong>End:</strong>
                    <input type="date" name="vacation_end" value="{{ $leave->vacation_end }}" placeholder="dd/mm/yy">
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Status:</strong>
                    <select class="form-control" name="status">
                    @foreach (['pending','approved','rejected'] as $status)
                        <option value="{{ $status }}" {{ ( $status == $leave->status) ? 'selected' : '' }}> 
                            {{ $status }} 
                        </option>
                      @endforeach
                    </select> 
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Reason:</strong>
                    <textarea readonly class="form-control" style="height:150px" name="reason">{{ $leave->reason }}</textarea>
                </div>
            </div>

		    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
		      <button type="submit" class="btn btn-primary">Submit</button>
		    </div>
		</div>

    </form>

<p class="text-center text-primary"><small>Epignosis</small></p>

@endsection