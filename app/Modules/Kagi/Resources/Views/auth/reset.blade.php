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
				<div class="panel-heading">{{ trans('kotoba::auth.reset_password') }}</div>
				<div class="panel-body">

					<form class="form-horizontal" role="form" method="POST" action="/password/reset">
						{!! csrf_field() !!}
						<input type="hidden" name="token" value="{{ $token }}">

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('kotoba::account.email') }}</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('kotoba::auth.password') }}</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">{{ trans('kotoba::auth.password_confirmation') }}</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn btn-primary">
									{{ trans('kotoba::auth.button.reset_password') }}
								</button>
							</div>
						</div>

				</form>

			</div><!-- ./panel-body -->
		</div><!-- ./panel -->


</div><!-- ./col -->
</div><!-- ./row -->

</div>
</div>



@endsection
