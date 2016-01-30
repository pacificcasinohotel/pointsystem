{{--*/ $acl = ACL::buildACL() /*--}}
<ul>
	<li class="active">
		<a href="{{route('dashboard')}}" title="Dashboard">
			<i class="fa fa-lg fa-fw fa-home"></i> <span class="menu-item-parent">Dashboard</span>
		</a>
	</li>
	
		@if(count($acl) > 0)
			@foreach($acl['nav'] as $key=>$val)
			<li>
				<a href="#">
					<i class="fa fa-lg fa-fw nav-fa-{{$key}}"></i> 
						<span class="menu-item-parent">{{ucfirst($key)}} </span>
				</a>
					<ul>
						@foreach($val as $row)
							@if($row['visible'] == 1) 
						<li>
							<a href="{{ route($row['perm_key']) }}">{{$row['perm_name']}} </a>
						</li>
							@endif
						@endforeach
					</ul>
			</li>
			@endforeach
		@endif						
</ul>