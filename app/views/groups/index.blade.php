@extends('layouts.main')
 {{--*/ $acl = ACL::buildACL() /*--}}
{{-- Web site Title --}}
@section('title')
    {{{ $title }}}
@stop

{{-- Content --}}
@section('content')
 {{--*/ $acl = ACL::buildACL() /*--}}
<!-- MAIN CONTENT -->
<div id="content">
    <div class="row">
        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <!--<h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i> User <span>> List </span>
            </h1> -->
            @if (array_key_exists('groups.create',$acl['access']))
            <a href="{{{ URL::action('groups.create') }}}" class="btn btn-labeled btn-success"> 
                <span class="btn-label">
                    <i class="fa fa-group"></i>
                </span>Add Group 
            </a>
            @endif

            <a href="{{{ URL::action('groups.permission') }}}" class="btn btn-labeled btn-warning"> 
                <span class="btn-label">
                    <i class="fa fa-lock"></i>
                </span>Group Permission 
            </a>
        </div>

         <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
            <!-- <ul id="sparks" class="">
                <li class="sparks-info">
                    <h5> Revenue <span class="txt-color-blue">P 47,171</span></h5>
                    <div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
                        1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
                    </div>
                </li>

                <li class="sparks-info">
                    <h5> Site Traffic <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;45%</span></h5>
                    <div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">
                        110,150,300,130,400,240,220,310,220,300, 270, 210
                    </div>
                </li>

                <li class="sparks-info">
                    <h5> Site Orders <span class="txt-color-greenDark"><i class="fa fa-shopping-cart"></i>&nbsp;2447</span></h5>
                    <div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">
                            110,150,300,130,400,240,220,310,220,300, 270, 210
                        </div>
                    </li>
            </ul> -->
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
                    <div class="jarviswidget jarviswidget-color-darken" id="wid-id-group-table" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Group Data Tables </h2>
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
                                        <th>ID</th>
                                        <th><i class="fa fa-fw fa-group text-muted hidden-md hidden-sm hidden-xs"></i> Group Name</th>
                                        <th>Group Description</th>
                                       <th><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Created</th>
                                        <th><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Update</th>
                                        <th>{{{ Lang::get('table.actions') }}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($groupList))
                                        @foreach($groupList as $row) 
                                    <tr>
                                        <td>{{ $row->id }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->description }}</td>
                                        <td>{{ date("M d Y h:i:s A",strtotime($row->date_created)) }} </td>
                                        <td>{{ date("M d Y h:i:s A",strtotime($row->date_updated)) }} </td>
                                        <td>
                                            @if (array_key_exists('groups.show',$acl['access']))
                                            <a href="{{{ URL::to('admin/v1/groups/show') }}}/{{ $row->id }}" class="btn btn-sm btn-primary">
                                                <span class="glyphicon glyphicon-eye-open"></span>
                                            </a>
                                            @endif

                                            @if (array_key_exists('groups.edit',$acl['access']))
                                            <a href="{{{ URL::to('admin/v1/groups/edit') }}}/{{ $row->id }}" class="btn btn-sm btn-success">
                                                <span class="glyphicon glyphicon-pencil"></span>
                                            </a>
                                            @endif

                                            @if (array_key_exists('groups.delete',$acl['access']))
                                            <a href="{{{ URL::to('admin/v1/groups/delete') }}}/{{ $row->id }}" class="btn btn-sm btn-danger">
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