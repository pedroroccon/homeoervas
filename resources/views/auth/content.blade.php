<div class="hello-login">
	<div class="hello-login-logo">
		<a href="{{ url('/') }}" target="_blank">
			<img class="animated flipInX" src="{{ asset('h-assets/images/login-logo.png') }}" width="190" height="57" title="BYUS Tecnologia" alt="Logotipo BYUS Tecnologia">
		</a>
	</div>

	<div class="hello-login-container">
		<div class="hello-login-form">
			{!! Form::open(['url' => 'login', 'class' => 'hello-form']) !!}

				<div class="row form-group">
					<div class="col">
						<h1 class="h4 text-primary">Entre com suas credenciais</h1>
					</div>
				</div>

				<!-- Mensagens do sistema -->
				@if($errors->any())
					<div class="row form-group">
						<div class="col">
							<div class="animated shake alert alert-danger text-center">
								@foreach ($errors->all() as $error)
									<strong>{{ $error }}</strong><br>
								@endforeach
							</div>
						</div>
					</div>
				@endif

				<div class="row form-group">
					<div class="col">
						{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Digite o seu e-mail...', 'autocomplete' => 'off', 'autofocus']) !!}
					</div>
				</div>
				<div class="row form-group">
					<div class="col">
						{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Digite a sua senha...']) !!}
					</div>
				</div>
				<div class="hello-login-controls">
					<div class="row align-items-center">
						<div class="col">
							<div class="custom-control custom-checkbox">
								<input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }} class="custom-control-input">
								<label class="custom-control-label">Lembrar?</label>
							</div>
						</div>
						<div class="col">
							{!! Form::submit('Entrar', ['class' => 'btn btn-block btn-primary']) !!}
						</div>
					</div>
				</div>
			{!! Form::close() !!}
		</div>

		<div class="hello-login-footer text-center">
		</div>
	</div>
</div>
<div class="hello-banner"></div>