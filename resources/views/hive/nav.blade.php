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
			<li><a href="{{ url(config('hello.url') . '/entrega/create?minimal=true') }}">Tela simplificada</a></li>
			<li><a href="{{ url(config('hello.url') . '/entrega') }}">Listar entregas</a></li>
			<li><a href="{{ url(config('hello.url') . '/entrega?semana=1') }}">Entregas da semana</a></li>
			<li><a href="{{ url(config('hello.url') . '/entrega?status=pendentes') }}">Pendentes</a></li>
			<li><a href="{{ url(config('hello.url') . '/entrega?status=pagas') }}">Pagas</a></li>
			<li><a href="{{ url(config('hello.url') . '/entrega/relatorio') }}">Relatórios</a></li>
		</ul>
	</div>
</div>