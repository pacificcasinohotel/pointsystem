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
                    <div class="jarviswidget jarviswidget-color-darken" id="wid-id-deposit-reports-table" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">
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
                        <h2>Points Redeemed Report</h2>
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
                                        <th><i class="fa fa-fw fa-gamepad text-muted hidden-md hidden-sm hidden-xs"></i> Playername</th>
                                        <th><i class="fa fa-fw fa-money txt-color-blue hidden-md hidden-sm hidden-xs"></i> Amount</th>
                                        <th><i class="fa fa-fw fa-money txt-color-blue hidden-md hidden-sm hidden-xs"></i> Coupon Code</th>
                                        <th><i class="fa fa-fw fa-calendar txt-color-blue hidden-md hidden-sm hidden-xs"></i> Date</th>
                                        <th><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Redeemer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($coupon))
                                        @foreach($coupon as $row) 
                                    <tr>    
                                        <td>{{ $row->playerdetails->username }}</td>
                                        <td><i class="fa fa-fw fa-usd text-muted hidden-md hidden-sm hidden-xs"></i> {{ $row->points }}</td>
                                        <td>{{ $row->coupon_code }}</td>
                                        <td>{{ $row->created_at }}</td>
                                        <td>{{ $row->redeemer->username }}</td>
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