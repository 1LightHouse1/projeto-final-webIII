const token = localStorage.getItem('api_token');
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
        document.getElementById('name').value = product.name;
        document.getElementById('description').value = product.description || '';
        document.getElementById('price').value = product.price;
        document.getElementById('stock').value = product.stock;
    } catch (error) {
        console.error('Erro ao carregar produto:', error);
    }
}

async function loadCategories() {
    try {
        const response = await fetch('/api/categories');
        const result = await response.json();
        
        if (result.status !== 'success') {
            console.error('Erro:', result.message);
            return;
        }
        
        const categories = result.data;
        const select = document.getElementById('category_id');
        categories.forEach(category => {
            const option = document.createElement('option');
            option.value = category.id;
            option.textContent = category.name;
            select.appendChild(option);
        });
        
        const productResponse = await fetch(`/api/products/${productId}`);
        const productResult = await productResponse.json();
        if (productResult.status === 'success' && productResult.data.category_id) {
            select.value = productResult.data.category_id;
        }
    } catch (error) {
        console.error('Erro ao carregar categorias:', error);
    }
}

document.getElementById('productForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = {
        name: document.getElementById('name').value,
        description: document.getElementById('description').value,
        price: document.getElementById('price').value,
        stock: document.getElementById('stock').value,
        category_id: document.getElementById('category_id').value
    };

    try {
        const response = await fetch(`/api/products/${productId}`, {
            method: 'PUT',
            headers: {
                'Authorization': `Bearer ${token}`,
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        });

        const result = await response.json();
        
        if (response.ok && result.status === 'success') {
            window.location.href = '/products';
        } else {
            alert(result.message || 'Erro ao atualizar produto');
        }
    } catch (error) {
        alert('Erro ao atualizar produto');
    }
});

loadProduct();
loadCategories();

