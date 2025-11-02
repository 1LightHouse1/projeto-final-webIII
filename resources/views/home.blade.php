@extends('layouts.app')

@section('title', 'Home')

@section('content')
<div class="jumbotron bg-light p-5 rounded mb-4">
    <h1 class="display-4">Bem-vindo ao E-Commerce</h1>
    <p class="lead">Sistema de e-commerce desenvolvido com Laravel</p>
    <hr class="my-4">
    <p>Explore nossos produtos e categorias</p>
    <a class="btn btn-primary btn-lg" href="{{ route('products.index') }}" role="button">Ver Produtos</a>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-box-seam"></i> Produtos</h5>
                <p class="card-text">Navegue pela nossa coleção de produtos</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary">Ver Produtos</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-tags"></i> Categorias</h5>
                <p class="card-text">Explore produtos por categoria</p>
                <a href="{{ route('categories.index') }}" class="btn btn-primary">Ver Categorias</a>
            </div>
        </div>
    </div>
    @auth
    <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><i class="bi bi-cart-check"></i> Meus Pedidos</h5>
                <p class="card-text">Acompanhe seus pedidos</p>
                <a href="{{ route('orders.index') }}" class="btn btn-primary">Ver Pedidos</a>
            </div>
        </div>
    </div>
    @endauth
</div>
@endsection

