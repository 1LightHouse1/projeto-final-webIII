const token = localStorage.getItem('api_token');

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
        const response = await fetch('/api/products', {
            method: 'POST',
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
            alert(result.message || 'Erro ao criar produto');
        }
    } catch (error) {
        alert('Erro ao criar produto');
    }
});

loadCategories();

