<div class="card card-tool has-hover">
	<a href="{{ route('tools.show', $tool->id) }}">
		<img src="{{ (substr($tool->thumbnail, 0, 4) === 'http') ? $tool->thumbnail : "/{$tool->thumbnail}" }}" 
			class="card-img" alt="{{ $tool->title }}">
		<div class="card-body">
			<h5 class="card-title">{{ $tool->title }}</h5>
			<p class="card-text">{{ $tool->tutorials_count }} مصدر</p>
		</div>
	</a>
</div>