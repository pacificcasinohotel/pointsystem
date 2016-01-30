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
						<p>Groups Details</p>
						<hr class="simple">
							<ul id="myTab1" class="nav nav-tabs bordered">
								<li class="active">
									<a href="#s1" data-toggle="tab"><i class="fa fa-fw fa-lg fa-user"></i> Group Details</a>
								</li>

								<li>
									<a href="#s2" data-toggle="tab"><i class="fa fa-fw fa-lg fa-lock"></i> Group Access</a>
								</li>
							</ul>
				
							<div id="myTabContent1" class="tab-content padding-10">
								<div class="tab-pane fade in active" id="s1">
									<div class="widget-body">
										<div class="table-responsive">
											<table id="user" class="table table-bordered table-striped" style="clear: both">
											<tbody>
												<tr>
													<td style="width:35%;">Group Name</td>
													<td style="width:65%">{{$groupInfo->name}}</td>
												</tr>

												<tr>
													<td style="width:35%;">Group Description</td>
													<td style="width:65%">{{$groupInfo->description}}</td>
												</tr>

												<tr>
													<td style="width:35%;">Date Created</td>
													<td style="width:65%">{{ date("M d Y h:i:s A",strtotime($groupInfo->date_created)) }}</td>
												</tr>

												<tr>
													<td style="width:35%;">Last Update</td>
													<td style="width:65%">{{ date("M d Y h:i:s A",strtotime($groupInfo->date_updated)) }} </td>
												</tr>

				
											</tbody>
										</table>
											
											
										</div>
									</div>
								</div>
											
								<div class="tab-pane fade" id="s2">
									<div class="widget-body">
										<div class="table-responsive">
											@if(count($groupAccess) > 0)
											<table id="user" class="table table-bordered table-striped" style="clear: both">
												<thread>
													<th>Permission Name</th>
													<th>Permission Key</th>
												</thread>
												<tbody>
													@foreach($groupAccess as $row)
													<tr>
													<td style="width:35%;">{{$row->aclPermission->perm_name}}</td>
													<td style="width:35%;">{{$row->aclPermission->perm_key}}</td>
													</tr>
													@endforeach	
												</tbody>
											</table>
											@else
											<div class="alert alert-warning fade in">
												<i class="fa-fw fa fa-warning"></i>
												<strong>Warning</strong> This group don't have any access.
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