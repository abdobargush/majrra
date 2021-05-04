<div class="card card-category has-hover">
	<a href="{{ $category->path }}">
		<img src="{{ $category->thumbnail }}" 
			class="card-img" alt="{{ $tool->title }}">
		<div class="card-body">
			<h5 class="card-title">{{ $category->title }}</h5>
			<p class="card-text">
				<span class="ml-2">{{ $category->tools_count }} أداة</span>
				<span>{{ $category->tutorials_count }} مصدر</span>
			</p>
		</div>
	</a>
</div>