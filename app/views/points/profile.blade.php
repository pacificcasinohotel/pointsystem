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
		<!-- row -->
		<div class="row">
			<!-- NEW COL START -->
			<article class="col-sm-12">
					<!-- Widget ID (each widget will need unique ID)-->
				<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-profile" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-custombutton="false">
					<!-- widget options:
						sage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
				
							data-widget-colorbutton="false"
								data-widget-editbutton="false"
								data-widget-togglebutton="false"
								data-widget-deletebutton="false"
								data-widget-fullscreenbutton="false"
								data-widget-custombutton="false"
								data-widget-collapsed="true"
								data-widget-sortable="false"
				
								-->
								<header>
									<span class="widget-icon"> <i class="fa fa-edit"></i> </span>
									<h2>My Profile </h2>
				
								</header>
				
								<!-- widget div-->
								<div>
				
									<!-- widget edit box -->
									<div class="jarviswidget-editbox">
										<!-- This area used as dropdown edit box -->
				
									</div>
									<!-- end widget edit box -->
				
									<!-- widget content -->
									<div class="widget-body">
				
										<table id="user" class="table table-bordered table-striped" style="clear: both">
											<tbody>
												<tr>
													<td style="width:15%;">Username</td>
													<td style="width:85%">{{$userInfo->username}}</a></td>
												</tr>
												<tr>
													<td style="width:15%;">Full Name</td>
													<td style="width:85%">{{$userInfo->fullname}}</a></td>
												</tr>
												<tr>
													<td style="width:15%;">Email</td>
													<td style="width:85%">{{$userInfo->email}}</a></td>
												</tr>
												<tr>
													<td style="width:15%;">Company</td>
													<td style="width:85%">{{$userInfo->company}}</a></td>
												</tr>
												<tr>
													<td style="width:15%;">Password</td>
													<td style="width:85%"><a data-toggle="modal" href="#myModal" id="password" data-type="text" data-pk="{{$userInfo->id}}" data-original-title="Change password">Change Password</a></a></td>
												</tr>
											</tbody>
										</table>
									</div>
									<!-- end widget content -->
				
								</div>
								<!-- end widget div -->
				
							</div>
							<!-- end widget -->	
				
						</article>
						<!-- END COL -->
				
					</div>
				
					<!-- end row -->
	</section>
	<!-- end widget grid -->
</div>
<!-- END MAIN CONTENT -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title">Change Password</h4>
			</div>

			<div class="modal-body no-padding">
				<form id="change-password-form" class="smart-form" method="POST">
					<input type="hidden" name="username" id="username" placeholder="Username" value="{{$userInfo->username}}">
					{{ Form::token() }}
					<fieldset>
						<section>
							<div class="row">
								<label class="label col col-3">Password</label>
									<div class="col col-9">
											<label class="input"> <i class="icon-append fa fa-lock"></i>

												<input type="password" name="password" placeholder="Change Password" id="pass" />
											</label>
									</div>
							</div>
							<div class="row">
								<label class="label col col-3">Confirm Password</label>
									<div class="col col-9">
											<label class="input"> <i class="icon-append fa fa-lock"></i>
												<input type="password" name="passwordConfirm" placeholder="Confirm Password" />
											</label>
									</div>
							</div>
						</section>
					</fieldset>
							
							<footer>
								<button type="submit" id="change-password" class="btn btn-primary">
									Change Password
								</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">
									Cancel
								</button>

							</footer>
						</form>						
			</div>

		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop
