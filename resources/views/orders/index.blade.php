@extends('layouts.app')

@section('title', 'Meus Pedidos')

@section('content')
<h2 class="mb-4">Meus Pedidos</h2>

<div id="ordersContainer"></div>

@section('scripts')
<script>
    const token = localStorage.getItem('api_token');
    
    async function loadOrders() {
        try {
            const response = await fetch('/api/orders', {
                headers: {
                    'Authorization': `Bearer ${token}`,
                    'Accept': 'application/json'
                }
            });
            
            if (!response.ok) {
                if (response.status === 401) {
                    window.location.href = '/login';
                    return;
                }
            }
            
            const orders = await response.json();
            
            const container = document.getElementById('ordersContainer');
            
            if (orders.length === 0) {
                container.innerHTML = '<p>Você não tem pedidos ainda.</p>';
                return;
            }
            
            container.innerHTML = '';
            
            orders.forEach(order => {
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
                            <li>${item.product ? item.product.name : 'Produto removido'} - 
                                Qtd: ${item.quantity} - 
                                R$ ${parseFloat(item.price).toFixed(2)}
                            </li>
                        `;
                    });
                }
                
                const card = `
                    <div class="card mb-3">
                        <div class="card-header d-flex justify-content-between">
                            <span>Pedido #${order.id}</span>
                            <span class="badge bg-${statusColor}">${statusLabel}</span>
                        </div>
                        <div class="card-body">
                            <p><strong>Total:</strong> R$ ${parseFloat(order.total).toFixed(2)}</p>
                            <p><strong>Itens:</strong></p>
                            <ul>${itemsHtml}</ul>
                            <p><small class="text-muted">Data: ${new Date(order.created_at).toLocaleString('pt-BR')}</small></p>
                            <a href="/orders/${order.id}" class="btn btn-sm btn-outline-primary">Ver Detalhes</a>
                        </div>
                    </div>
                `;
                container.innerHTML += card;
            });
        } catch (error) {
            console.error('Erro ao carregar pedidos:', error);
        }
    }

    if (!token) {
        window.location.href = '/login';
    } else {
        loadOrders();
    }
</script>
@endsection
@endsection

