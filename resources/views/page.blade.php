@extends('layouts.app')
@section('title', $page->title)

@section('content')
<header>
	<div class="container">
		<div class="row">
			<div class="col text-center">
				<h3 class="mb-3">{{ $page->title }}</h3>
			</div>
		</div>
	</div>
</header>
<div id="content" class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">

                <div class="card-body">

					<article>
						{!! $page->content !!}
					</article>
					
					
                </div>
            </div>
        </div>
    </div>
</div>
@endsection