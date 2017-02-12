@extends($theme_simple)

@section('content')



<div id="flex-container">
<div id="flex-item">

	<div class="padding-bottom-xl">
		<img src="{{ asset('themes/' . $activeTheme . '/assets/img/logo.png') }}">
	</div>

<div class="row padding-top-xl">
<div class="col-sm-12">

		<div class="panel panel-default">
			<div class="panel-heading">
				{{ trans('kotoba::auth.confirmation') }}
			</div>
			<div class="panel-body">

				{!! Form::open([
					'url' => ['auth/confirm', $code],
					'method' => 'POST',
					'class' => 'form'
				]) !!}

					<div class="form-group">
						<label class="col-md-4 control-label">{{ trans('kotoba::account.email') }}</label>
						<div class="col-md-6">
							<input type="email" class="form-control" name="email" value="{{ old('email') }}" autofocus>
						</div>
					</div>

<br>
<br>
<br>

					<div class="form-group">
						<div class="col-md-6 col-md-offset-4">
							<button type="submit" class="btn btn-success btn-block">
								{{ trans('kotoba::button.register') }}
							</button>
						</div>
					</div>

				{!! Form::close() !!}

			</div><!-- ./panel-body -->
		</div><!-- ./panel -->

</div><!-- ./col -->
</div><!-- ./row -->

</div>
</div>



@endsection
