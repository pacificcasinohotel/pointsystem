@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
  {{{ $title }}}
@stop

{{-- Content --}}
@section('content')
<!-- MAIN CONTENT -->
<div id="content">
	@include('notifications')
<!-- widget grid -->
<section id="widget-grid" class="">
	<!-- START ROW -->
	<div class="row">
		<!-- NEW COL START -->
		<article class="col-sm-12 col-md-12 col-lg-6">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-groupadd" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
					<h2>{{$title}}</h2>				
					
				</header>

				<!-- widget div-->
				<div>
					
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
						
					</div>
					<!-- end widget edit box -->
					
					<!-- widget content -->
					<div class="widget-body no-padding">
						
						{{$formOpen}}
						{{ Form::token() }}
							<header>Group Details</header>

							<fieldset>
								<section>
									<label class="input"> <i class="icon-append fa fa-group"></i>
										<input type="text" name="name" placeholder="Group Name" value="{{ Input::old('groupname') }}">
										<b class="tooltip tooltip-bottom-right">Need to enter the group name.</b> </label>
								</section>
								<section>
									<label class="input">
										<input type="text" name="description" placeholder="Group Description" value="{{ Input::old('description') }}">
										<b class="tooltip tooltip-bottom-right">Need to enter the group description.</b> </label>
								</section>

							</fieldset>
							@if (!empty($permissonList))
							<header>Group Permission</header>
							<fieldset>
								<section>
									<label class="label">Permission</label>
										<div class="row">
											<div class="col col-4">
												@foreach($permissonList as $row)
												<label class="checkbox">
													{{ Form::checkbox('permission[]', $row->id, null, ['type'=>'checkbox']) }}
													<i></i>{{ $row->perm_name }}</label>
												@endforeach
											</div>
										</div>	
									</section>
							</fieldset>
							@endif

							<footer>
								<button type="submit" class="btn btn-primary">
									Submit Form
								</button>
								<a href="{{{ URL::action('settings.groups') }}}" class="btn btn-danger">Cancel</a>
							</footer>
						{{$formClose}}					
						
					</div>
					<!-- end widget content -->
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->
						
		</article>
		<!-- END COL -->		

	</div>

	<!-- END ROW -->

</section>
<!-- end widget grid -->

</div>
<!-- END MAIN CONTENT -->
@stop