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
			<div class="jarviswidget" id="wid-id-permission-edit" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false">
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
							<header>Permission Details</header>

							<fieldset>
								<section>
									<label class="input"> <i class="icon-append fa fa-lock"></i>
										{{Form::text('perm_name', $permissionInfo->perm_name, array('placeholder' => 'Permssion Name','id' => 'perm_name'))}}
										<b class="tooltip tooltip-bottom-right">Permssion Name</b> </label>
								</section>
								<!--
								<section>
									<label class="input"> <i class="icon-append fa fa-key"></i>
										{{Form::text('perm_key', $permissionInfo->perm_key, array('placeholder' => 'Permssion Key','id' => 'perm_key'))}}	
										<b class="tooltip tooltip-bottom-right">Permission Key</b> </label>
								</section>
							-->
								<!--
								<section>
									<label class="label">Visible</label>
										<div class="inline-group">
											<label class="radio">
												{{Form::radio('visible', '1', ( ($permissionInfo->visible == 1) ? true : false) )}}
														<i></i>Yes
											</label>

											<label class="radio">
												{{Form::radio('visible', '0', ( ($permissionInfo->visible == 0) ? true : false) )}}
														<i></i>No</label>
											</label>
		

										</div>
								</section>
								-->
							</fieldset>
							<footer>
								<button type="submit" class="btn btn-primary">
									Submit Form
								</button>
								<a href="{{{ URL::action('settings.permission') }}}" class="btn btn-danger">Cancel</a>
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