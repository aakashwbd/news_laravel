@extends('vendor.installer.layouts.master')

@section('title', trans('messages.final.title'))
@section('container')
    <p class="paragraph">{{ $message }}</p>
    @if ($isAllOk)
        <div class="buttons">
            <a href="/" class="button">{{ trans('messages.final.exit') }}</a>
        </div>
    @else
        <div class="buttons">
            <a href="/install/environment" class="button">Back to Environment</a>
        </div>
    @endif
@stop
