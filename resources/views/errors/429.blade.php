@extends('errors.layout')
@section('title')
  Too many requests.
@endsection
@section('errorNumber', '429')

@section('description')
  @php
    $default_error_message = "Please <a href='javascript:history.back()''>go back</a> and try again, or return to <a href='".url('')."'>our homepage</a>.";
  @endphp
  {!! isset($exception)? ($exception->getMessage()?$exception->getMessage():$default_error_message): $default_error_message !!}
@endsection