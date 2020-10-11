@extends('layouts.app')
@section('title', 'جميع التقنيات والأدوات')
@section('description', 'تصفح جميع الأدوات والتقنيات المنشورة على مجرة وتعلم ماتحب. أفضل الكورسات والمصادر التعليمية في مختلف المجالات مصنفة ومرتبة حسب الأداة والتقنية.')

@section('content')
<header class="before-content">
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<h2>{{ __('جميع التقنيات والأوات') }}</h2>
			</div>
		</div>
	</div>
</header>
<div id="content" class="container mb-4">
    <div class="row justify-content-center">
		@foreach ($tools as $tool)
			<div class="col-12 col-md-6 col-lg-4">
				@include('components.tool-card', compact('tool'))
			</div>
		@endforeach
	</div>
	<div class="row">
		<div class="col text-center">
			{{ $tools->links() }}
		</div>
	</div>
</div>
@endsection
