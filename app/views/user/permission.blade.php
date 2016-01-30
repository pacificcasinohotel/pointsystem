@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
  {{{ $title }}}
@stop

{{-- Content --}}
@section('content')
<div id="content">
	<hr class="simple">
	<div class="row">
		<div class="col-sm-5">
			<div class="well">
			<h2>Permission for {{ $userInfo->fullname }}</h2>
				{{ $formOpen }}
   				{{ Form::token() }}
				
				{{$select}}
				<a href="{{{ URL::action('settings.user') }}}" class="btn btn-danger">Cancel</a>
				<button type="submit" class="btn btn-primary">
					Permission
				</button>
					
				{{ $formClose }}
			</div>
		</div>
	</div>
</div>
@stop