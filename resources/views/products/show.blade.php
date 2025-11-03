@extends('layouts.app')

@section('title', 'Detalhes do Produto')

@section('content')
<div id="productDetails"></div>

@section('scripts')
<script>
    window.productId = {{ $id }};
    window.isAdmin = @json(Auth::check() && Auth::user()->role === 'admin');
</script>
<script src="{{ asset('js/products-show.js') }}"></script>
@endsection
@endsection

