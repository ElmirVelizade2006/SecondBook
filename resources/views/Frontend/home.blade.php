@extends('Layout.Frontend.master')

@section('title', 'Home | SecondBook')

@section('content')
    @include('Layout.Frontend.billboard')
    @include('Layout.Frontend.categories')
    @include('Layout.Frontend.featured-books')
    @include('Layout.Frontend.popular-books')
    @include('Layout.Frontend.why-choose')
    @include('Layout.Frontend.special-offer')
    @include('Layout.Frontend.subscribe')
@endsection