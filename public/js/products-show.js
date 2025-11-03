const productId = window.productId;

async function loadProduct() {
    try {
        const response = await fetch(`/api/products/${productId}`);
        const result = await response.json();
        
        if (result.status !== 'success') {
            console.error('Erro:', result.message);
            return;
        }
        
        const product = result.data;
        const container = document.getElementById('productDetails');
        
        const adminButtons = window.isAdmin ? `<a href="/products/${product.id}/edit" class="btn btn-primary">Editar</a>` : '';
        
        container.innerHTML = `
            <div class="card">
                <div class="card-body">
                    <h2>${product.name}</h2>
                    <p>${product.description || 'Sem descrição'}</p>
                    <p><strong>Preço:</strong> R$ ${parseFloat(product.price).toFixed(2)}</p>
                    <p><strong>Estoque:</strong> ${product.stock}</p>
                    <p><strong>Categoria:</strong> ${product.category ? product.category.name : 'Sem categoria'}</p>
                    <a href="/products" class="btn btn-secondary">Voltar</a>
                    ${adminButtons}
                </div>
            </div>
        `;
    } catch (error) {
        console.error('Erro ao carregar produto:', error);
    }
}

loadProduct();

