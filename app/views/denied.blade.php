@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
    {{{ $title }}}
@stop

{{-- Content --}}
@section('content')
    <!-- MAIN CONTENT -->
			<div id="content">

				<!-- row -->
				<div class="row">
				
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				
						<div class="row">
							<div class="col-sm-12">
								<div class="text-center error-box">
									<h1 class="error-text tada animated"><i class="fa fa-times-circle text-danger error-icon-shadow"></i> Permission Denied</h1>									
									<br />
									<ul class="error-search text-left font-md">
							            <li><a href="{{ route('dashboard') }}"><small>Go to My Dashboard <i class="fa fa-arrow-right"></i></small></a></li>
							        </ul>
								</div>
				
							</div>
				
						</div>
				
					</div>
					
				</div>
				<!-- end row -->

			</div>
			<!-- END MAIN CONTENT -->
@stop