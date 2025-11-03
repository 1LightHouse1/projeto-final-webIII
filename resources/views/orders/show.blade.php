@extends('layouts.app')

@section('title', 'Detalhes do Pedido')

@section('content')
<div id="orderDetails"></div>

@section('scripts')
<script>
    window.orderId = {{ $id }};
</script>
<script src="{{ asset('js/orders-show.js') }}"></script>
@endsection
@endsection

