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
		<div class="jarviswidget well" id="wid-id-permission-info" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
				<header>
					<span class="widget-icon"> <i class="fa fa-comments"></i> </span>
					<h2>Default Tabs with border </h2>
				</header>

				<!-- widget div-->
				<div>
					<!-- widget edit box -->
					<div class="jarviswidget-editbox"></div>
					<div class="widget-body">
						<p>Permission Details</p>
						<hr class="simple">
							<ul id="myTab1" class="nav nav-tabs bordered">
								<li class="active">
									<a href="#s1" data-toggle="tab"><i class="fa fa-fw fa-lg fa-user"></i> Permission</a>
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
													<td style="width:65%">{{$permissionInfo->perm_name}}</td>
												</tr>

												<tr>
													<td style="width:35%;">Group Description</td>
													<td style="width:65%">{{$permissionInfo->perm_key}}</td>
												</tr>

												<tr>
													<td style="width:35%;">Date Created</td>
													<td style="width:65%">{{ date("M d Y h:i:s A",strtotime($permissionInfo->date_created)) }}</td>
												</tr>

												<tr>
													<td style="width:35%;">Last Update</td>
													<td style="width:65%">{{ date("M d Y h:i:s A",strtotime($permissionInfo->date_updated)) }} </td>
												</tr>

				
											</tbody>
										</table>
											
											
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