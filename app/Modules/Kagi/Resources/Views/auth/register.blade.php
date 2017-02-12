@extends($theme_simple)

@section('content')



<div id="flex-container">
<div id="flex-item">

	<div class="padding-bottom-xl">
		<img src="{{ asset('themes/' . $activeTheme . '/assets/img/logo.png') }}">
	</div>

<div class="row padding-top-xl">
<div class="col-sm-12">

<div role="tabpanel">

	<!-- Nav tabs -->
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation"><a href="/auth/login" aria-controls="social" role="tab">{{ trans('kotoba::button.social_log_in') }}</a></li>
		<li role="presentation"><a href="/password/email" aria-controls="forgot_password" role="tab">{{ trans('kotoba::button.forgot_password') }}</a></li>
		<li role="presentation" class="active"><a href="#register" aria-controls="register" role="tab" data-toggle="tab">{{ trans('kotoba::button.register') }}</a></li>
		<li role="presentation"><a href="/auth/login" aria-controls="login">{{ trans('kotoba::button.admin') }}</a></li>
		@include($activeTheme . '::' . '_partials.language')
	</ul>

	<!-- Tab panes -->
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="register">

				<form class="form-horizontal margin-top-xl" role="form" method="POST" action="/auth/register">
					{!! csrf_field() !!}

						<div class="form-group">
							<label class="col-md-3 control-label">{{ trans('kotoba::account.name') }}</label>
							<div class="col-md-9">
								<input type="text" class="form-control" name="name" value="{{ old('name') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">{{ trans('kotoba::account.email') }}</label>
							<div class="col-md-9">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">{{ trans('kotoba::auth.password') }}</label>
							<div class="col-md-9">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-3 control-label">{{ trans('kotoba::auth.password_confirmation') }}</label>
							<div class="col-md-9">
								<input type="password" class="form-control" name="password_confirmation">
							</div>
						</div>

					<div class="form-group">
						<label class="col-md-3 control-label"></label>
						<div class="col-md-9">
							<button type="submit" class="btn btn-primary btn-block">
								{{ trans('kotoba::button.register') }}
							</button>
						</div>
					</div>

				</form>

		</div>
	</div>

</div>

</div><!-- ./col -->
</div><!-- ./row -->

</div>
</div>



@endsection
