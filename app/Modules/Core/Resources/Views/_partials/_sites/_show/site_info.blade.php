<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			{{ trans('kotoba::general.information') }}:
		</h3>
	</div><!-- ./panel-heading -->
	<div class="panel-body">
	<div class="row">
		<div class="col-md-4">

			<dl class="dl-horizontal">
				<dt>
					{{ trans('kotoba::account.address') }}:
				</dt>
				<dd>
					{{ $site->address }}
					<br>
					{{ $site->city }}, {{ $site->state }}&nbsp;&nbsp;&nbsp;{{ $site->zipcode }}
				</dd>
			</dl>

			<dl class="dl-horizontal">
				<dt>
					{{ trans('kotoba::account.website') }}:
				</dt>
				<dd>
					<a href="{{ $site->website }}">{{ $site->website }}</a>
				</dd>
			</dl>

			<dl class="dl-horizontal">
				<dt>
					{{ trans('kotoba::account.primary_phone') }}:
				</dt>
				<dd>
					{{ $site->phone_1 }}
				</dd>
			</dl>

			<dl class="dl-horizontal">
				<dt>
					{{ trans('kotoba::account.secondary_phone') }}:
				</dt>
				<dd>
					{{ $site->phone_2 }}
				</dd>
			</dl>

		</div>
		<div class="col-md-4">

			<dl class="dl-horizontal">
				<dt>
					{{ trans('kotoba::general.contact') }}:
				</dt>
				<dd>
					{{-- $site->user_id --}}
					{{-- $contact --}}
				</dd>
			</dl>

			<dl class="dl-horizontal">
				<dt>
					{{ Lang::choice('kotoba::hr.division', 1) }}:
				</dt>
				<dd>
					{{-- $site->division_id --}}
					{{-- $division --}}
				</dd>
			</dl>

			<dl class="dl-horizontal">
				<dt>
					{{ trans('kotoba::account.email') }}:
				</dt>
				<dd>
					{{ $site->email }}
				</dd>
			</dl>

		</div>
		<div class="col-md-4">
{{--
			@if($logo != NULL)
				{!! HTML::image('/images/sites/' . $logo, '', ['class' => 'img-thumbnail']) !!}
			@else
				{!! HTML::image('assets/images/bld.png', '', ['class' => 'img-thumbnail']) !!}
			@endif
--}}
			@if ($image != null)
				<div class="thumbnail">
					<img src="<?= $image->image->url('preview') ?>" class="img-rounded">
				</div>
			@else
				<img src="{{ asset('/assets/images/bld.png') }}" class="img-thumbnail" />
			@endif

		</div>
	</div><!-- ./row -->
	</div><!-- ./panel-body -->
</div><!-- ./panel -->

<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">
			{{ trans('kotoba::general.introduction') }}
		</h3>
	</div>
	<div class="panel-body">
		{{ $site->notes }}
	</div>
</div>
