@if ($crud->hasAccess('show'))
<a href="{{ url( $crud->route . '/' . $entry->getKey() . '/show') }} " class="btn btn-xs btn-link">
	<i class="la la-edit"></i> {{ __('Review') }}
</a>
@endif