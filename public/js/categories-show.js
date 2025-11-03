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
        const container = document.getElementById('categoryDetails');
        
        const adminButtons = window.isAdmin ? `<a href="/categories/${category.id}/edit" class="btn btn-primary">Editar</a>` : '';
        
        container.innerHTML = `
            <div class="card">
                <div class="card-body">
                    <h2>${category.name}</h2>
                    <p>${category.description || 'Sem descrição'}</p>
                    <a href="/categories" class="btn btn-secondary">Voltar</a>
                    ${adminButtons}
                </div>
            </div>
        `;
    } catch (error) {
        console.error('Erro ao carregar categoria:', error);
    }
}

loadCategory();

