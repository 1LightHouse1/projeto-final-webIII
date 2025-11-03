@extends('layouts.app')

@section('title', 'Detalhes da Categoria')

@section('content')
<div id="categoryDetails"></div>

@section('scripts')
<script>
    window.categoryId = {{ $id }};
    window.isAdmin = @json(Auth::check() && Auth::user()->role === 'admin');
</script>
<script src="{{ asset('js/categories-show.js') }}"></script>
@endsection
@endsection

