@extends('layouts.app')
@section('content')
    @livewire('admin.user.user', ['title' => $title])
    @livewire('admin.user.form')
@endsection
