const token = localStorage.getItem('api_token');
const categoryId = window.categoryId;

async function loadCategory() {
    try {
        const response = await fetch(`/api/categories/${categoryId}`);
        const result = await response.json();
        
        if (result.status !== 'success') {
            console.error('Erro:', result.message);
            return;
        }
        
        const category = result.data;
        document.getElementById('name').value = category.name;
        document.getElementById('description').value = category.description || '';
    } catch (error) {
        console.error('Erro ao carregar categoria:', error);
    }
}

document.getElementById('categoryForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = {
        name: document.getElementById('name').value,
        description: document.getElementById('description').value
    };

    try {
        const response = await fetch(`/api/categories/${categoryId}`, {
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
            window.location.href = '/categories';
        } else {
            alert(result.message || 'Erro ao atualizar categoria');
        }
    } catch (error) {
        alert('Erro ao atualizar categoria');
    }
});

loadCategory();

