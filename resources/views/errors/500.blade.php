@extends('errors.layout')
@section('title', __('Internal Server Error.'))
@section('errorNumber', '500')

@section('description')
  @php
    $default_error_message = __('Oops, it\'s my fault! If the error persists please contact us.');
  @endphp
  {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
@endsection