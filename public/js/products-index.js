async function loadProducts() {
    try {
        const response = await fetch('/api/products');
        const result = await response.json();
        
        if (result.status !== 'success') {
            console.error('Erro:', result.message);
            return;
        }
        
        const products = result.data;
        const container = document.getElementById('productsContainer');
        container.innerHTML = '';
        
        products.forEach(product => {
            const adminButtons = window.isAdmin ? `<a href="/products/${product.id}/edit" class="btn btn-sm btn-outline-secondary">Editar</a>` : '';
            
            const card = `
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">${product.name}</h5>
                            <p class="card-text">${product.description || ''}</p>
                            <p class="card-text"><strong>R$ ${parseFloat(product.price).toFixed(2)}</strong></p>
                            <p class="card-text">Estoque: ${product.stock}</p>
                            <p class="card-text">
                                <small class="text-muted">Categoria: ${product.category ? product.category.name : 'Sem categoria'}</small>
                            </p>
                            <a href="/products/${product.id}" class="btn btn-sm btn-outline-primary">Ver Detalhes</a>
                            ${adminButtons}
                        </div>
                    </div>
                </div>
            `;
            container.innerHTML += card;
        });
    } catch (error) {
        console.error('Erro ao carregar produtos:', error);
    }
}

loadProducts();

