<div class="hello-vertical-nav d-print-none">

	<div class="hello-nav-top">
		<!-- Profile -->
		<div class="hello-nav-profile">
			<div class="row no-gutters d-flex align-items-center">

				<!-- Imagem do profile -->
				<div class="col-2 col-lg-12">
					<div class="hello-nav-profile-image">
						<img class="img-fluid" src="{{ asset('h-assets/images/profile.png') }}" alt="Imagem do profile">
					</div>
				</div>

				<div class="col-8 col-lg-12 text-center">
					<!-- Informações do profile -->
					<span>Olá, {{ auth()->check() ? auth()->user()->name : 'Visitante' }}</span>
					<small class="d-none d-lg-block">{{ today()->format('d/m/Y') }}</small>
				</div>

				<div class="col-2 d-lg-none text-right">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav"><i class="fas fa-bars fa-xs"></i></button>
				</div>
			</div>

			<div class="hello-nav-profile-line"></div>
		</div>
	</div>

	<!-- Menu principal -->
	<div class="hello-nav-menu-container">
		<div class="hello-nav-menu">

			<nav class="navbar navbar-expand-lg">
				<div class="collapse navbar-collapse" id="main-nav">
					<div id="hello-nav-accordion" data-children=".item" style="overflow: auto;">
						<div class="item">
							<div class="hello-nav-menu-item-image"><img src="{{ asset('h-assets/svg/hello-svg/001-rgb.svg') }}" alt="Início"></div>
							<a class="hello-nav-menu-item" href="{{ url(config('hello.url')) }}">Início</a>
						</div>

						<!-- Customizações -->
						@includeIf('hive.nav')
						
						<!-- Sistema -->
						<div class="item">
							<div class="hello-nav-menu-item-image"><img src="{{ asset('h-assets/svg/hello-svg/007-html.svg') }}" alt="Sistema"></div>
							<a class="hello-nav-menu-item" data-toggle="collapse" data-parent="#hello-nav-accordion" href="#nav-sistema">Sistema</a>
							<div id="nav-sistema" class="collapse">
								<ul class="hello-nav-list">
									<li><a href="{{ url(config('hello.url') . '/empresa') }}">Minha empresa</a></li>
									<li><a href="{{ url(config('hello.url') . '/usuario') }}">Usuários</a></li>
									<li><a href="{{ url(config('hello.url') . '/usuario/create') }}">Adicionar usuário</a></li>
									<li><a href="{{ url(config('hello.url') . '/operacao') }}">Operações</a></li>
									<li><a href="{{ url(config('hello.url') . '/localidade') }}">Localidades</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</nav>

			<!-- App developer bar -->
			@if(env('APP_DEBUG'))
				<div class="mt-4 text-center">
					@if(env('NF_AMBIENTE') == 2)
						<hr>
						<span class="badge badge-danger"><i class="fas fa-exclamation-triangle fa-fw fa-sm mr-1"></i> Nota fiscal em homologação</span><br>
					@endif
					<span class="badge badge-danger"><i class="fas fa-exclamation-triangle fa-fw fa-sm mr-1"></i> App em modo debug</span><br>
					<span class="badge badge-danger animated flash infinite"><i class="fas fa-database fa-fw fa-sm mr-1"></i> Database {{ env('DB_DATABASE') }}</span>
				</div>
			@endif
		</div>
	</div>
</div>
