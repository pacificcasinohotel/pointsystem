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
			<div class="jarviswidget" id="wid-id-useradd" data-widget-editbutton="false" data-widget-custombutton="false" data-widget-fullscreenbutton="false" data-widget-colorbutton="false">
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
							<header>Add User Form</header>

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

								<section>
									<label class="input"> <i class="icon-append fa fa-lock"></i>
										<input type="password" name="password" placeholder="Password" id="password">
										<b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
								</section>

								<section>
									<label class="input"> <i class="icon-append fa fa-lock"></i>
										<input type="password" name="passwordConfirm" placeholder="Confirm password">
										<b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
								</section>
							</fieldset>

							<fieldset>
								<div class="row">
									<section class="col col-6">
										<label class="input">
											<input type="text" name="fullname" placeholder="Full name" value="{{ Input::old('fullname') }}">
										</label>
									</section>
									<section class="col col-6">
										<label class="input">
											<input type="text" name="company" placeholder="Company" value="{{ Input::old('company') }}">
										</label>
									</section>
								</div>
								<section>
									<label class="label">Account Status</label>
										<div class="inline-group">
											<label class="radio">
												<input type="radio" name="confirm" value="1" checked="checked">
														<i></i>Active
											</label>

											<label class="radio">
												<input type="radio" name="confirm" value="0">
														<i></i>Inactive</label>
											</label>
		

										</div>
								</section>
								@if (!empty($groupList))
								<!-- roles -->
								<section class="col col-5">
									<label class="label">Group</label>
										@foreach($groupList as $row)
										<label class="toggle">
											{{ Form::checkbox('usermember[]', $row->id, null, ['type'=>'checkbox']) }}		
											<i data-swchon-text="ON" data-swchoff-text="OFF"></i> {{ $row->name }}
										</label>
										@endforeach
											
								</section>
								<!-- ./ roles --> 
								@endif
							</fieldset>
							<footer>
								<button type="submit" class="btn btn-primary">
									Submit Form
								</button>
								<a href="{{{ URL::action('settings.user') }}}" class="btn btn-danger">Cancel</a>
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