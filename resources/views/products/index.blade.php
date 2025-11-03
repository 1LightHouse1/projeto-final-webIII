@extends('layouts.app')

@section('title', 'Produtos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Produtos</h2>
    @auth
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('products.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Novo Produto
            </a>
        @endif
    @endauth
</div>

<div class="row" id="productsContainer">
</div>

@section('scripts')
<script>
    window.isAdmin = @json(Auth::check() && Auth::user()->role === 'admin');
</script>
<script src="{{ asset('js/products-index.js') }}"></script>
@endsection
@endsection

