@extends('layouts.app')

@section('title', 'Meus Pedidos')

@section('content')
<h2 class="mb-4">Meus Pedidos</h2>

<div id="ordersContainer"></div>

@section('scripts')
<script src="{{ asset('js/orders-index.js') }}"></script>
@endsection
@endsection

