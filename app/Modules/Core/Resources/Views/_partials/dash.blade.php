<h2>
	<i class="fa fa-keyboard-o fa-lg"></i>
	{{ Lang::choice('kotoba::shop.asset', 2) }}
	<hr>
</h2>

<div class="row">
<div class="col-sm-6">

	<dl class="dl-horizontal">
		<dt>
			{{ trans('kotoba::general.all') }}
		</dt>
		<dd>
			<a href="{{ URL::to('/admin/asset') }}">{{ $total_assets }}</a>
		</dd>
	</dl>

</div>
<div class="col-sm-6">

	<dl class="dl-horizontal">
		<dt>
			{{ date("Y") }}&nbsp;{{ Lang::choice('kotoba::general.year', 1) }}
		</dt>
		<dd>
			<a href="{{ URL::to('/admin/asset') }}">{{ $total_assets_year }}</a>
		</dd>
	</dl>

</div>
</div>
