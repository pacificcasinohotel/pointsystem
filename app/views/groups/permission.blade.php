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
                    <div class="jarviswidget jarviswidget-color-darken" id="wid-id-group-permission-table" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false">

                    <header>
                        <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                        <h2>Group Permission</h2>
                    </header>
                
                    <!-- widget div-->
                    <div>
                       
                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox"></div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body no-padding">
                            {{$formOpen}}
                            <table class="table table-bordered table-striped responsive-utilities">
                                <thead>
                                    <tr>
                                        <th class="col-md-4">Functions</th>
                                        @if (!empty($groupList))
                                            @foreach($groupList as $row) 
                                        <th>{{$row->name}}</th>
                                            @endforeach
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($permissionList))
                                        @foreach($permissionList as $permission) 
                                    <tr>
                                        <th class="col-md-4"><code>{{$permission->perm_name}}</code></th>
                                            @foreach($groupList as $row) 
                                            <td class="col-md-1">                           
                                                <label class="checkbox">
                                                     {{--*/ $groupId = isset($groupPermission[$row->id]) ? true : false /*--}}
                                                     @if($groupId == true)
                                                       @if(in_array($permission->id, $groupPermission[$row->id]))  
                                                         <input type="checkbox" name="permission[{{$row->id}}][]" value="{{$permission->id}}" checked="checked"> <i></i> 
                                                       @else 
                                                        <input type="checkbox" name="permission[{{$row->id}}][]" value="{{$permission->id}}"><i></i> 
                                                       @endif
                                                     @else
                                                        <input type="checkbox" name="permission[{{$row->id}}][]" value="{{$permission->id}}"><i></i>      
                                                     @endif
                                            </td>
                                            @endforeach
        
                                        @endforeach
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                             <footer>
                                <button type="submit" class="btn btn-primary">Manage Permission</button>
                                    <a href="{{{ URL::action('settings.groups') }}}" class="btn btn-danger">Cancel</a>
                            </footer>
                             {{$formClose}}
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