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
            @if (array_key_exists('player.create',$acl['access']))
            <a href="{{{ URL::action('player.create') }}}" class="btn btn-labeled btn-success"> 
                <span class="btn-label">
                    <i class="fa fa-user"></i>
                </span>Add Player 
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
                    <div class="jarviswidget jarviswidget-color-darken" id="wid-id-player-table" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
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
                        <h2>PLayer List </h2>
                    </header>
                
                    <!-- widget div-->
                    <div>
                       
                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox"></div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body no-padding">

                            <table id="dt_basic" class="table table-striped table-bordered" width="100%">
                                <thead>
                                    <tr>
                                        <th><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> PlayerName</th>
                                        <th>Fullname</th>
                                        <th><i class="fa fa-fw fa-send-o txt-color-blue hidden-md hidden-sm hidden-xs"></i> Email</th>
                                        <th><i class="fa fa-fw fa-credit-card txt-color-blue hidden-md hidden-sm hidden-xs"></i> Serial Number</th>
                                        <th>Status</th>
                                        <th><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Created</th>
                                        <th>{{{ Lang::get('table.actions') }}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($userList))
                                        @foreach($userList as $row) 
                                    <tr>    
                                        <td>{{ $row->user->username }}</td>
                                        <td>{{ $row->user->fullname }}</td>
                                        <td>{{ $row->user->email }}</td>
                                        <td>{{ $row->user->rfid_serial }}</td>
                                        <td>{{ $status[$row->user->confirmed]['status'] }}</td>
                                        <td>{{ $row->user->created_at }}</td>
                                        <td>
                                        @if (array_key_exists('user.edit',$acl['access']))
                                            <a href="{{{ URL::route('player.edit', $row->user->id) }}}" class="btn btn-sm btn-success">
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
<!-- ui-dialog -->
<!-- <div id="dialog_simple" title="Dialog Simple Title" tabindex="-1">
    <form id="add-credit-form" class="smart-form" method="POST" action="">
        {{ Form::token() }}
            <fieldset>
                <div class="form-group has-success">
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input class="form-control wallet_credits" type="text" id="credits" name="credits">
                        </div>
                    </div>
                </div>
            </fieldset>
            <input type="hidden" name="option" value="deposit">                
    </form> 
</div>

<div id="dialog_withdraw" title="Dialog Simple Title" tabindex="-1">
    <form id="withdraw-credit-form" class="smart-form" method="POST" action="">
        {{ Form::token() }}
            <fieldset>
                <div class="form-group has-error">
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input class="form-control withdraw_credits" type="text" id="credits" name="credits">
                        </div>
                    </div>
                </div>
            </fieldset>
            <input type="hidden" name="option" value="withdraw">                
    </form> 
</div> -->
@stop