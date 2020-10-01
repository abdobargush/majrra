@extends('errors.layout')
@section('title')
  Forbidden.
@endsection
@section('errorNumber', '403')

@section('description')
  @php
    $default_error_message = "Please <a href='javascript:history.back()''>go back</a> or return to <a href='".url('')."'>our homepage</a>.";
  @endphp
  {!! isset($exception) && config('app.debug') ? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
@endsection