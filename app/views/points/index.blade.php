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
                                        <th><i class="fa fa-fw fa-gift txt-color-blue hidden-md hidden-sm hidden-xs"></i> Player Points</th>
                                        <th><i class="fa fa-fw fa-credit-card txt-color-blue hidden-md hidden-sm hidden-xs"></i> Serial Number</th>
                                        <th>{{{ Lang::get('table.actions') }}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($userList))
                                        @foreach($userList as $row)
                                            @if($row->user->rfid_login == 1) 
                                    <tr>    
                                        <td>{{ $row->user->username }}</td>
                                        <td>{{ $row->user->fullname }}</td>
                                        <td>{{ $row->points->credits }}</td>
                                        <td>{{ $row->user->rfid_serial }}</td>
                                        <td>
                                            <a data-playerid="{{$row->user->id}}" data-toggle="modal" data-target="#myModal" class= "btn btn-sm btn-success"><span class="fa fa-plus-circle"></span></a>
                                            <a href="{{ URL::action('points.logout',$row->user->id) }}" class="btn btn-sm btn-danger" title="Logout Player"><span class="fa fa-sign-out"></span></a>                                       
                                        </td>
                                    </tr>
                                        @endif
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

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Add Player Bets</h4>
            </div>
        <div class="modal-body">

            <div class="row">
                <div class="col-md-12">
                    <div class="well well-sm well-primary">
                    <form id="withdraw-credit-form" class="smart-form" method="POST" action="">
                     {{ Form::token() }}
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            <input class="form-control player_bets" type="text" id="bets" name="bets">

                        </div>
                    </div>
                </div>
            </div>
        </div>
       
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button id="player-csv" type="submit" class="btn btn-primary">Add Bet</button>
        </div>
        </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@stop