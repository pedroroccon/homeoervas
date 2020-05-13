<div class="item">
	<div class="hello-nav-menu-item-image"><img src="{{ asset('h-assets/svg/hello-svg/040-delivery.svg') }}" alt="Entregas"></div>
	<a class="hello-nav-menu-item" data-toggle="collapse" data-parent="#hello-nav-accordion" href="#nav-entrega">Entregas</a>
	<div id="nav-entrega" class="collapse">
		{!! Form::open(['url' => config('hello.url') . '/entrega', 'method' => 'get']) !!}
			{!! Form::text('keyword', null, ['class' => 'form-control form-control-sm', 'placeholder' => 'Buscar...', 'autocomplete' => 'off']) !!}
			{!! Form::hidden('campo', 'smart') !!}
		{!! Form::close() !!}
		<ul class="hello-nav-list">
			<li><a href="{{ url(config('hello.url') . '/entrega/create') }}">Adicionar entrega</a></li>
			<li><a href="{{ url(config('hello.url') . '/entrega') }}">Listar entregas</a></li>
			<li><a href="{{ url(config('hello.url') . '/entrega?semana=1') }}">Entregas da semana</a></li>
			<li><a href="{{ url(config('hello.url') . '/entrega?status=pendentes') }}">Pendentes</a></li>
			<li><a href="{{ url(config('hello.url') . '/entrega?status=pagas') }}">Pagas</a></li>
			<li><a href="{{ url(config('hello.url') . '/entrega/relatorio') }}">Relatórios</a></li>
			<!--<li><a href="{{ url(config('hello.url') . '/entrega/relatorio/semanal/show?inicio=' . today()->format('Y-m-d') . '&termino=' . today()->format('Y-m-d') . '&ordenar=impresso_em') }}">Fechamento de hoje</a></li>
			<li><a href="{{ url(config('hello.url') . '/entrega/relatorio/semanal/show?inicio=' . today()->startOfWeek()->format('Y-m-d') . '&termino=' . today()->endOfWeek()->format('Y-m-d') . '&ordenar=impresso_em') }}">Fechamento da semana atual</a></li>
			<li><a href="{{ url(config('hello.url') . '/entrega/relatorio/semanal/show?inicio=' . today()->subWeek(1)->startOfWeek()->format('Y-m-d') . '&termino=' . today()->subWeek(1)->endOfWeek()->format('Y-m-d') . '&ordenar=impresso_em') }}">Fechamento da semana passada</a></li>-->
			<li><a href="{{ url(config('hello.url') . '/entrega/create?minimal=true') }}">Tela simplificada</a></li>
		</ul>
	</div>
</div>