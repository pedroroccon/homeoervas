@if ($errors->any())
<div class="hello-flash-messages animated fadeInDown d-print-none">
	<ul class="alert alert-danger list-unstyled">
		@foreach ($errors->all() as $error)
			<li><i class="fas fa-times-circle mr-2"></i> {!! $error !!}</li>
		@endforeach
	</ul>
</div>
@endif
