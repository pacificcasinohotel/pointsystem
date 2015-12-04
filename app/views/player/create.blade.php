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
			<div class="jarviswidget" id="wid-id-playeradd" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false">
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
							<header>Player Credentials</header>

							<fieldset>
								<section>
									<label class="input"> <i class="icon-append fa fa-user"></i>
										<input type="text" name="username" id="username" placeholder="Username" value="{{ Input::old('username') }}">
										<b class="tooltip tooltip-bottom-right">Needed to enter the webtool</b> </label>
								</section>
								
								
								
								<section>
									<label class="input"> <i class="icon-append fa fa-envelope-o"></i>
										<input type="email" name="email" placeholder="Email address" value="{{ Input::old('email') }}">
										<b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
								</section>

							</fieldset>

							<fieldset>
								<div class="row">
									<section class="col col-6">
										<label class="input">
											<input type="text" name="fullname" placeholder="Full name" value="{{ Input::old('fullname') }}">
										</label>
									</section>
								</div>

							</fieldset>

							<header>Player RFID Serial</header>

							<fieldset>
								
								<section class="col col-6">
									<div class="row">
										<div class="col-sm-12">
													<div class="input-group">
														<span class="input-group-addon"><a id="rfid_serial"><i class="fa fa-credit-card"></i></a> </span>
														<input data-rfid="{{ $url_rfid }}" class="form-control rfid_serial_input" id="appendprepend" type="text" name="rfid_serial_show" readonly=""> 
														<input type="hidden" id="hidden_rfid_serial" name="rfid_serial" value="">
													</div>
											</div>
										</div>		
									</section>
							</fieldset>

							<footer>
								<button type="submit" class="btn btn-primary">
									Submit Form
								</button>
								<a href="{{{ URL::action('player.index') }}}" class="btn btn-danger">Cancel</a>
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