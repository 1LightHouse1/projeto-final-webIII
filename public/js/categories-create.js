const token = localStorage.getItem('api_token');

document.getElementById('categoryForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = {
        name: document.getElementById('name').value,
        description: document.getElementById('description').value
    };

    try {
        const response = await fetch('/api/categories', {
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
            window.location.href = '/categories';
        } else {
            alert(result.message || 'Erro ao criar categoria');
        }
    } catch (error) {
        alert('Erro ao criar categoria');
    }
});

