async function loadCategories() {
    try {
        const response = await fetch('/api/categories');
        const result = await response.json();
        
        if (result.status !== 'success') {
            console.error('Erro:', result.message);
            return;
        }
        
        const categories = result.data;
        const container = document.getElementById('categoriesContainer');
        container.innerHTML = '';
        
        categories.forEach(category => {
            const adminButtons = window.isAdmin ? `<a href="/categories/${category.id}/edit" class="btn btn-sm btn-outline-secondary">Editar</a>` : '';
            
            const card = `
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">${category.name}</h5>
                            <p class="card-text">${category.description || ''}</p>
                            <a href="/categories/${category.id}" class="btn btn-sm btn-outline-primary">Ver Detalhes</a>
                            ${adminButtons}
                        </div>
                    </div>
                </div>
            `;
            container.innerHTML += card;
        });
    } catch (error) {
        console.error('Erro ao carregar categorias:', error);
    }
}

loadCategories();

