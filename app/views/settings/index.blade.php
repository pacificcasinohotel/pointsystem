@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
    {{{ $title }}}
@stop

{{-- Content --}}
@section('content')
<!-- MAIN CONTENT -->
<div id="content">
    <section id="widget-grid" class="">
         @include('notifications')
        <!-- row -->
        <div class="row">
            <!-- NEW WIDGET START -->
                <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="jarviswidget jarviswidget-color-darken" id="wid-id-settings-table" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Settings Data Tables </h2>
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
                                        <th><i class="fa fa-fw fa-gears text-muted hidden-md hidden-sm hidden-xs"></i> Setting Name</th>
                                        <th>Function</th>
                                        <th>Value</th>
                                       <th><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Created</th>
                                        <th><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Update</th>
                                        <th>{{{ Lang::get('table.actions') }}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($settingList))
                                        @foreach($settingList as $row) 
                                    <tr>
                                        <td>{{ $row->id }}</td>
                                        <td>{{ $row->display_name }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ $row->value }}</td>
                                        <td>{{ date("M d Y h:i:s A",strtotime($row->created_at)) }} </td>
                                        <td>{{ date("M d Y h:i:s A",strtotime($row->updated_at)) }} </td>
                                        <td>
                                            @if (array_key_exists('groups.edit',$acl['access']))
                                            <a href="{{{ URL::to('admin/v1/settings/edit') }}}/{{ $row->id }}" class="btn btn-sm btn-success">
                                                <span class="glyphicon glyphicon-pencil"></span>
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