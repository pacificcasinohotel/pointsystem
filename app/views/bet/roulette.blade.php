@extends('layouts.main')

{{-- Web site Title --}}
@section('title')
  {{{ $title }}}
@stop

{{-- Content --}}
@section('content')
<div id="content">
	@include('notifications')
	<!-- row -->	
		<div class="row">
			<div class="col-sm-12">
				
							<div class="well well-sm">
				
								<div class="row">
				
									<div class="col-sm-12 col-md-12 col-lg-6">
										<div class="well well-light well-sm no-margin no-padding">
				
											<div class="row">
				
												<div class="col-sm-12">
													<div id="myCarousel" class="carousel fade profile-carousel">
														<div class="air air-top-left padding-10">
															<h4 class="txt-color-white font-md"></h4>
														</div>
														<ol class="carousel-indicators">
															<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
															<li data-target="#myCarousel" data-slide-to="1" class=""></li>
														</ol>
														<div class="carousel-inner">
															<!-- Slide 1 -->
															<div class="item active">
																<img src="{{asset('assets/img/demo/roulette.jpg')}}" alt="demo user">		
															</div>
															<!-- Slide 2 -->
															<div class="item">
																<img src="{{asset('assets/img/demo/table-roulette.jpg')}}" alt="demo user">
															</div>
														</div>
													</div>
												</div>
				
												<div class="col-sm-12">
				
													<div class="row">
				
														<div class="col-sm-3 profile-pic">
															<img src="{{ asset('assets/img/avatars/avatar-girl.jpg') }}" alt="demo user">
															<div class="padding-10">
																<h4 class="font-md"><strong><i class="fa fa-usd"></i> {{ $playerdetails->wallet->credits }}</strong>
																<br>
																<small>Total Credits</small></h4>
																<br>
															</div>
														</div>
														<div class="col-sm-6">
															<h1>Player</span>
															<br>
															<small> Name: <span class="semi-bold">{{ $playerdetails->username }} </span></small></h1>
															
															<h1>
															<small> Game Details <span class="semi-bold"></span></small></h1>

															<ul class="list-unstyled">
																<li>
																	<p class="text-muted">
																		<i class="fa fa-user"></i>&nbsp;&nbsp;<span class="txt-color-darken game_id">{{ $gamedetails->tabledetails->operator->username }}</span>
																	</p>
																</li>
																<li>
																	<p class="text-muted">
																		<i class="fa fa-gamepad"></i>&nbsp;&nbsp;<span class="txt-color-darken game_id">{{ $gamedetails->channel_id }}</span>
																		<span class="hide txt-color-darken channel_id">{{ $gamedetails->id }}</span>
																	</p>
																</li>
																<li>
																	<p class="text-muted">
																		<i class="fa fa-info-circle"></i>&nbsp;&nbsp;<span class="txt-color-darken">@if($gamedetails->channel_status == 1) <span class="">Open</span> @else <span class="">Closed</span> @endif</span>
																	</p>
																</li>
																<li>
																	<p class="text-muted">
																		<i class="fa fa-calendar"></i>&nbsp;&nbsp;<span class="txt-color-darken">Opened <a href="javascript:void(0);" rel="tooltip" title="" data-placement="top" data-original-title="Bet Starts Now!">{{ date("M d Y H:i:s",strtotime($gamedetails->created_at)) }}</a></span>
																	</p>
																</li>
															</ul>
				
														</div>
				
													</div>
				
												</div>
				
											</div>
				
											<div class="row">
				
												<div class="col-sm-12">
				
													<div class="padding-10">
				
														<ul class="nav nav-tabs tabs-pull-left">
															<li class="active pull-left">
																<span class="margin-top-10 display-inline"></span>
															</li>
														</ul>
											
											<div class="panel-group smart-accordion-default" id="accordion">
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"> 
													<i class="fa fa-lg fa-angle-down pull-right"></i> 
													<i class="fa fa-lg fa-angle-up pull-right"></i> Straight, Split, Line, Square & Double Street Bet</a></h4>
												</div>
												<div id="collapseOne" class="panel-collapse collapse">
													<div class="panel-body no-padding">
												
												{{ $formOpen }}
												{{ Form::token() }}
												<fieldset>
													<section>
														<div class="row">
															@for ($i = 1; $i <= 36; $i++)
															<div class="col col-4">
																<label class="checkbox">
																	<input type="checkbox" name="betnumber[]" value="{{ $i }}">
																	<i></i>{{$i}}
																</label>
															</div>
															@endfor
														</div>
													</section>
													<section>
														<label class="input">
														<div class="input-group">
                            								<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                            								<input class="form-control" type="text" name="amount">
                            								</div>
														</label>
													</section>
												</fieldset>
													<footer>
														<button type="submit" class="btn btn-primary">Place Bet</button>
													</footer>
														<input type="hidden" name="game_id" value="{{ $gamedetails->id }}">	
													</form>
													</div>
												</div>
											</div>
											<div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" class="collapsed"> 
													<i class="fa fa-lg fa-angle-down pull-right"></i> 
													<i class="fa fa-lg fa-angle-up pull-right"></i> Group Bet</a></h4>
												</div>
												<div id="collapseTwo" class="panel-collapse collapse">
													<div class="panel-body">
														{{ $formOpen }}
															{{ Form::token() }}
															<fieldset>
																<div class="row">
																	<section class="col col-4">
																		<label class="select">
																		<select name="bettype">
																			<option value="0" selected="" disabled="">Select Bet</option>
										                      				<option value="even">Even</option>
										                        			<option value="odd">Odd</option>
													                        <option value="black">Black</option>
													                        <option value="red">Red</option>
													                        <option value="low">Low (1-18)</option>
													                        <option value="high">High (19-36)</option>
													                        <option value="1dozen">1st 12</option>
													                        <option value="2dozen">2nd 12</option>
													                        <option value="3dozen">3rd 12</option>
													                        <option value="1stcolumn">Column 1</option>
													                        <option value="2ndcolumn">Column 2</option>
													                        <option value="3rdcolumn">Column 3</option>
													                        </select> <i></i> 
													                    </label>
																</section>

														<section class="col col-5">
															<label class="input">
															<div class="input-group">
	                            								<span class="input-group-addon"><i class="fa fa-dollar"></i></span>
	                            								<input class="form-control" type="text" name="amount">
	                            								</div>
															</label>
														</section>
										
													</div>
														</fieldset>
														<footer>
															<button type="submit" class="btn btn-primary">Place Bet</button>
														</footer>
														<input type="hidden" name="game_id" value="{{ $gamedetails->id }}">			
														</form>
													</div>
												</div>
											</div>
											<!-- <div class="panel panel-default">
												<div class="panel-heading">
													<h4 class="panel-title">
													<a data-toggle="collapse" data-parent="#accordion" href="#collapseThree" class="collapsed"> 
													<i class="fa fa-lg fa-angle-down pull-right"></i> 
													<i class="fa fa-lg fa-angle-up pull-right"></i> Current Bets </a></h4>
												</div>
												<div id="collapseThree" class="panel-collapse collapse">
													<div class="panel-body">
														Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
													</div>
												</div>
											</div> -->

											</div>
				
													</div>
				
												</div>
				
											</div>
											<!-- end row -->
				
										</div>
				
									</div>

								</div>
							</div>
				
					</div>
				
				</div>
				
				<!-- end row -->
</div>
@stop