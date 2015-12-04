@extends('layouts.main')
{{-- Web site Title --}}
@section('title')
    {{{ $title }}}
@stop

{{-- Content --}}
@section('content')
<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <!--<h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i> User <span>> List </span>
            </h1> -->
            @if (array_key_exists('user.create',$acl['access']))
            <a href="{{{ URL::action('user.create') }}}" class="btn btn-labeled btn-success"> 
                <span class="btn-label">
                    <i class="fa fa-user"></i>
                </span>Add User 
            </a>
            @endif
        </div>

         <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
            
        </div>
    </div> 
    <br />
    <!-- widget grid -->
    <section id="widget-grid" class="">
         @include('notifications')
        <!-- row -->
        <div class="row">
            <!-- NEW WIDGET START -->
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="jarviswidget jarviswidget-color-darken" id="wid-id-user-table" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
                    <!-- widget options:usage: <div class="jarviswidget" id="wid-id-user-table" data-widget-editbutton="false">
                         data-widget-colorbutton="false"
                         data-widget-editbutton="false"
                         data-widget-togglebutton="false"
                         data-widget-deletebutton="false"
                         data-widget-fullscreenbutton="false"
                         data-widget-custombutton="false"
                         data-widget-collapsed="true"
                         data-widget-sortable="false" -->
                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Users Data Tables </h2>
                    </header>
                
                    <!-- widget div-->
                    <div>
                       
                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox"></div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body no-padding">

                            <table id="dt_basic" class="table table-striped table-bordered table-hover" width="100%">
                                <thead>
                                    <tr>
                                        <th><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Username</th>
                                        <th>Fullname</th>
                                        <th><i class="fa fa-fw fa-send-o txt-color-blue hidden-md hidden-sm hidden-xs"></i> Email</th>
                                        <th>Status</th>
                                        <th><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Created</th>
                                        <th>{{{ Lang::get('table.actions') }}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($userList))
                                        @foreach($userList as $row) 
                                    <tr>
                                        <td>{{ $row->username }}</td>
                                        <td>{{ $row->fullname }}</td>
                                        <td>{{ $row->email }}</td>
                                        <td>{{ $status[$row->confirmed]['status'] }}</td>
                                        <td>{{ $row->created_at }}</td>
                                        <td>
                                            @if (array_key_exists('user.show',$acl['access']))
                                            <a href="{{{ URL::to('admin/v1/user/show') }}}/{{ $row->id }}" class="btn btn-sm btn-primary">
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                            </a>
                                            @endif

                                            @if (array_key_exists('user.edit',$acl['access']))
                                            <a href="{{{ URL::to('admin/v1/user/edit') }}}/{{ $row->id }}" class="btn btn-sm btn-success">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </a>

                                                @if ($row->status == 0)
                                                    <a href="{{{ URL::to('admin/v1/user/updatestatus') }}}/{{ $row->id }}" class="btn btn-sm btn-success" title="Unlock User">
                                                        <span class="glyphicon glyphicon-ok"></span>
                                                    </a>
                                                @else
                                                    <a href="{{{ URL::to('admin/v1/user/updatestatus') }}}/{{ $row->id }}" class="btn btn-sm btn-danger" title="Lock User">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </a>
                                                @endif

                                            @endif

                                            <a href="{{{ URL::to('admin/v1/user/reset_password') }}}/{{ $row->id }}" class="btn btn-sm btn-primary" title="Reset Password">
                                                <span class="glyphicon glyphicon-repeat"></span>
                                            </a>

                                            @if (array_key_exists('user.permission',$acl['access']))
                                            <a href="{{{ URL::to('admin/v1/user/permission') }}}/{{ $row->id }}" class="btn btn-sm btn-warning">
                                                <span class="glyphicon glyphicon-lock"></span>
                                            </a>
                                            @endif

                                            @if (array_key_exists('user.delete',$acl['access']))
                                            <a href="{{{ URL::to('admin/v1/user/delete') }}}/{{ $row->id }}" class="btn btn-sm btn-danger">
                                                <span class="glyphicon glyphicon-trash"></span>
                                            </a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                          <!-- end widget content -->
                    </div>
                    <!-- end widget div -->
                </div>
                <!-- end widget -->
            </article>
            <!-- WIDGET END -->
        </div>
        <!-- end row -->
    </section>
    <!-- end widget grid -->
</div>
<!-- END MAIN CONTENT -->
@stop