@extends('errors.layout')
@section('title', __('Method not allowed.'))
@section('errorNumber', '405')

@section('description')
  @php
    $default_error_message = __('Looks like you got lost in the space!');
  @endphp
  {!! isset($exception) && config('app.debug') ? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
@endsection