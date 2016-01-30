@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
{{{ $title }}}
@stop

{{-- Content --}}
@section('content')
<div id="content">
	<article class="col-sm-12 col-md-12 col-lg-6">
		<!-- Widget ID (each widget will need unique ID)-->
		<div class="jarviswidget well" id="wid-id-userinfo" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-comments"></i> </span>
					<h2>Default Tabs with border </h2>
				</header>

				<!-- widget div-->
				<div>
					<!-- widget edit box -->
					<div class="jarviswidget-editbox"></div>
					<div class="widget-body">
						<p>User Details</p>
						<hr class="simple">
							<ul id="myTab1" class="nav nav-tabs bordered">
								<li class="active">
									<a href="#s1" data-toggle="tab"><i class="fa fa-fw fa-lg fa-user"></i>User Profile</a>
								</li>

								<li>
									<a href="#s2" data-toggle="tab"><i class="fa fa-fw fa-lg fa-gear"></i> User Access</a>
								</li>

								<li>
									<a href="#s3" data-toggle="tab"><i class="fa fa-fw fa-lg fa-group"></i> Member</a>
								</li>
							</ul>
				
							<div id="myTabContent1" class="tab-content padding-10">
								<div class="tab-pane fade in active" id="s1">
									<div class="widget-body">
										<div class="table-responsive">
											<table id="user" class="table table-bordered table-striped" style="clear: both">
											<tbody>
												<tr>
													<td style="width:35%;">Username</td>
													<td style="width:65%">{{$userInfo->username}}</td>
												</tr>

												<tr>
													<td style="width:35%;">Full Name</td>
													<td style="width:65%">{{$userInfo->fullname}}</td>
												</tr>

												<tr>
													<td style="width:35%;">Email</td>
													<td style="width:65%">{{$userInfo->email}}</td>
												</tr>


												<tr>
													<td style="width:35%;">Company</td>
													<td style="width:65%">{{$userInfo->company}}</td>
												</tr>

												<tr>
													<td style="width:35%;">Date Created</td>
													<td style="width:65%">{{ date("M d Y h:i:s A",strtotime($userInfo->created_at)) }}</td>
												</tr>

												<tr>
													<td style="width:35%;">Last Update</td>
													<td style="width:65%">{{ date("M d Y h:i:s A",strtotime($userInfo->updated_at)) }} </td>
												</tr>

												<tr>
													<td style="width:35%;">Last Login</td>
													<td style="width:65%">{{ date("M d Y h:i:s A",strtotime($userInfo->last_login)) }} </td>
												</tr>

												<tr>
													<td style="width:35%;">Last Login IP</td>
													<td style="width:65%">{{$userInfo->last_login_ip}}</td>
												</tr>
				
											</tbody>
										</table>
											
											
										</div>
									</div>
								</div>
											
								<div class="tab-pane fade" id="s2">
									<div class="widget-body">
										<div class="table-responsive">
											@if(count($userAccess) > 0)
											<table id="user" class="table table-bordered table-striped" style="clear: both">
												<thread>
													<th>Permission Name</th>
													<th>Permission Key</th>
												</thread>
												<tbody>
													@foreach($userAccess as $row)
													<tr>
													<td style="width:35%;">{{$row['perm_name']}}</td>
													<td style="width:35%;">{{$row['perm_key']}}</td>
													</tr>
													@endforeach	
												</tbody>
											</table>
											@else
											<div class="alert alert-warning fade in">
												<i class="fa-fw fa fa-warning"></i>
												<strong>Warning</strong> This account don't have any access.
											</div>
											@endif
										</div>
									</div>
								</div>
								
								<div class="tab-pane fade" id="s3">
									<div class="widget-body">
										<div class="table-responsive">
											@if(count($userMember) > 0)
											<table id="user" class="table table-bordered table-striped" style="clear: both">
												<thread>
													<th>Group Name</th>
													<th>Group Description</th>
												</thread>
												<tbody>
													@foreach($userMember as $row)
													<tr>
													<td style="width:35%;">{{$row->group->name}}</td>
													<td style="width:35%;">{{$row->group->description}}</td>
													</tr>
													@endforeach	
												</tbody>
											</table>
											@else
											<div class="alert alert-warning fade in">
												<i class="fa-fw fa fa-warning"></i>
												<strong>Warning</strong> This account doesn't belong to any group.
											</div>
											@endif
										</div>
									</div>
								</div>			
							</div>
					</div>
					<!-- end widget content -->		
				</div>
				<!-- end widget div -->
		</div>
		<!-- end widget -->
	</article>
	<!-- WIDGET END -->
</div>	
@stop