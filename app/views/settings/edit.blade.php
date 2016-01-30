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
			<div class="jarviswidget" id="wid-id-settingedit" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
					<h2>{{$title}}</h2>				
					
				</header>
				<div>
					<div class="jarviswidget-editbox"></div>
						<div class="widget-body">
							{{$formOpen}}
								{{ Form::token() }}
								<fieldset>
									<legend>Setting Info</legend>
									<div class="form-group">
											<label></label>
											<div class="col-md-10">
												<input class="form-control" name="display_name" placeholder="Setting Display Name" type="text" value="{{$settingsInfo->display_name}}">
											</div>	
									</div>

									<!--
									<div class="form-group">
											<label></label>
											<div class="col-md-10">
												<input class="form-control" name="name" placeholder="Setting Name" type="text" value="{{$settingsInfo->name}}">
											</div>	
									</div>
									-->
								</fieldset>

								<fieldset>
									<legend>Setting Value</legend>
												<div class="row">
													<div class="col-sm-6 col-md-4 col-lg-4">
														<div class="form-group">
															<input class="form-control spinner-right"  id="spinner" name="value" value="{{$settingsInfo->value}}" type="text">
														</div>
				
													</div>
												</div>
				
											</fieldset>
								<div class="form-actions">
									<footer>
										<a href="{{{ URL::action('settings.index') }}}" class="btn btn-danger">Cancel</a>
										<button type="submit" class="btn btn-primary">Edit</button>
									</footer>
								</div>
							{{$formClose}}
						</div>
					</div>			
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