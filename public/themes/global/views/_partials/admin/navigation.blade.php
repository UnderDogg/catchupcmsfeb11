<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
<div class="container-fluid">

<div class="navbar-header">
	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		<span class="sr-only">Toggle Navigation</span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
		<span class="icon-bar"></span>
	</button>
	<a class="navbar-brand" href="/admin">
		{{ Setting::get('brand_title', Config::get('core.brand_title')) }}
	</a>
</div>

<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

@if (Auth::user())

{{-- @if (Auth::user()->can('manage_shisan')) --}}
@if ( Config::get('shisan.show_category_menu') == true)
	<ul class="nav navbar-nav">
		<li>
		<a href="#" class="sitemap" id="showLeft">
			{{ Lang::choice('kotoba::general.category', 2) }}
		</a>
		</li>
	</ul>
@endif
@endif


	@if (Auth::user())
		<ul class="nav navbar-nav">
{{--
			@include('_partials.menu', ['items'=> $menu_navbar->roots()])
			@include('_partials.menu_links')
--}}
		</ul>
	@endif
	<ul class="nav navbar-nav navbar-right">
		@if (Auth::guest())
			<li><a href="/auth/login">{{ trans('kotoba::auth.log_in') }}</a></li>
			<li><a href="/auth/register">{{ trans('kotoba::auth.register') }}</a></li>
		@else
			<li>
				@if (Auth::user()->avatar != null)
					<img
						src="{{ asset(Auth::user()->avatar) }}"
						alt="{{ Auth::user()->email }}"
						class="img-circle nav-profile"
					/>
				@else
					<img
						src="{{ asset('/assets/images/usr.png') }}"
						alt="{{ Auth::user()->email }}"
						class="img-circle nav-profile"
					/>
				@endif
			</li>
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					{{ Auth::user()->name }} <span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li>
						<a href="/profiles/{{ Auth::user()->id }}">
							{{ Lang::choice('kotoba::account.profile', 1) }}
						</a>
					</li>
				<li class="divider"></li>
@if (Auth::user()->can('manage_admin'))
					<li>
						<a href="/admin/users">
							{{ Lang::choice('kotoba::account.user', 2) }}
						</a>
					</li>
					<li>
						<a href="/admin/roles">
							{{ Lang::choice('kotoba::role.role', 2) }}
						</a>
					</li>
					<li>
						<a href="/admin/permissions">
							{{ Lang::choice('kotoba::permission.permission', 2) }}
						</a>
					</li>
					<li class="divider"></li>
					{!!
						Widget::MenuAdmin()
					!!}
					<li class="divider"></li>
@endif
					<li>
						<a href="/auth/logout">
							{{ trans('kotoba::auth.log_out') }}
						</a>
					</li>
				</ul>
			</li>
		@endif
	</ul>


	<ul class="nav navbar-nav navbar-right">
		<li class="dropdown messages-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
				<img alt="{{ Session::get('locale')  }}" src="{{ asset('/assets/images/famfamfam_flag_icons/png/' . Session::get('locale') . '.png') }}">
				<b class="caret"></b>
			</a>
			<ul class="dropdown-menu">
				@foreach( $languages as $language)
					<li>
						<a rel="alternate" hreflang="{{ $language->locale }}" href="/language/{{ $language->locale }}">
							<img alt="{{ $language->locale }}" src="{{ asset('/assets/images/famfamfam_flag_icons/png/' . $language->locale . '.png') }}">
							{{{ $language->name }}}
						</a>
					</li>
				@endforeach
			</ul>
		</li>
	</ul>


@if (Auth::user()->can('manage_admin'))
	<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					{{ Lang::choice('kotoba::general.setting', 2) }} <span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li>
					{!!
						Widget::MenuSettings()
					!!}
					</li>
				</ul>
			</li>
		</ul>

	<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					{{ trans('kotoba::general.other') }} <span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li>
					{!!
						Widget::MenuOther()
					!!}
					</li>
				</ul>
			</li>
		</ul>

	<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					{{ trans('kotoba::hr.office') }} <span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li>
					{!!
						Widget::MenuOffice()
					!!}
					</li>
				</ul>
			</li>
		</ul>

	<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					{{ Lang::choice('kotoba::shop.record', 2) }} <span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li>
					{!!
						Widget::MenuReports()
					!!}
					</li>
				</ul>
			</li>
		</ul>

	<ul class="nav navbar-nav navbar-right">
			<li class="dropdown">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
					{{ Lang::choice('kotoba::shop.order', 2) }} <span class="caret"></span>
				</a>
				<ul class="dropdown-menu" role="menu">
					<li>
					{!!
						Widget::MenuOrders()
					!!}
					</li>
				</ul>
			</li>
		</ul>
@endif

@if (Auth::user()->can('manage_admin'))
	<ul class="nav navbar-nav navbar-right">
	</ul>
@endif



</div>

</div><!-- ./container-fluid -->
</nav><!-- /nav -->
