@extends('layouts.app')

@section('title', 'Detalhes do Pedido')

@section('content')
<div id="orderDetails"></div>

@section('scripts')
<script>
    const token = localStorage.getItem('api_token');
    const orderId = {{ $id }};
    
    async function loadOrder() {
        try {
            const response = await fetch(`/api/orders/${orderId}`, {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            
            if (!response.ok) {
                window.location.href = '/login';
                return;
            }
            
            const order = await response.json();
            
            const statusColors = {
                'pending': 'warning',
                'processing': 'info',
                'completed': 'success',
                'cancelled': 'danger'
            };
            
            const statusLabels = {
                'pending': 'Pendente',
                'processing': 'Em Processamento',
                'completed': 'Concluído',
                'cancelled': 'Cancelado'
            };
            
            const statusColor = statusColors[order.status] || 'secondary';
            const statusLabel = statusLabels[order.status] || order.status;
            
            let itemsHtml = '';
            if (order.order_items) {
                order.order_items.forEach(item => {
                    itemsHtml += `
                        <tr>
                            <td>${item.product ? item.product.name : 'Produto removido'}</td>
                            <td>${item.quantity}</td>
                            <td>R$ ${parseFloat(item.price).toFixed(2)}</td>
                            <td>R$ ${(parseFloat(item.price) * item.quantity).toFixed(2)}</td>
                        </tr>
                    `;
                });
            }
            
            const container = document.getElementById('orderDetails');
            container.innerHTML = `
                <div class="card">
                    <div class="card-header">
                        <h3>Pedido #${order.id}</h3>
                        <span class="badge bg-${statusColor}">${statusLabel}</span>
                    </div>
                    <div class="card-body">
                        <p><strong>Total:</strong> R$ ${parseFloat(order.total).toFixed(2)}</p>
                        <p><strong>Data:</strong> ${new Date(order.created_at).toLocaleString('pt-BR')}</p>
                        
                        <h5 class="mt-4">Itens do Pedido</h5>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Preço Unitário</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                ${itemsHtml}
                            </tbody>
                        </table>
                        
                        <a href="/orders" class="btn btn-secondary">Voltar</a>
                    </div>
                </div>
            `;
        } catch (error) {
            console.error('Erro ao carregar pedido:', error);
        }
    }

    if (!token) {
        window.location.href = '/login';
    } else {
        loadOrder();
    }
</script>
@endsection
@endsection

