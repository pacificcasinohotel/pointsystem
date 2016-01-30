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
					<span class="widget-icon"> <i class="fa fa-table"></i> </span>
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

							<fieldset>
								<section class="col col-6">
									<label class="input"> <i class="icon-append fa fa-gear"></i>
										<input type="text" name="tablename" id="tablename" placeholder="Table Name" value="{{ Input::old('tablename') }}">
										<b class="tooltip tooltip-bottom-right">Roulette Table Name</b> </label>
								</section>

								<section class="col col-6">
										<label class="select">
											<select name="operator">
												<option value="" selected="" disabled="">Assign Operator</option>
												  @if (!empty($operators))
                                       				@foreach($operators as $row)
                                       					<option value="{{ $row->user_id }}">{{ $row->user->username }}</option>
                                       				@endforeach	
                                       			  @endif	 
											</select> <i></i> </label>
								</section>
							

							</fieldset>							

							<footer>
								<button type="submit" class="btn btn-primary">
									Submit Form
								</button>
								<a href="{{{ URL::action('games.index') }}}" class="btn btn-danger">Cancel</a>
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