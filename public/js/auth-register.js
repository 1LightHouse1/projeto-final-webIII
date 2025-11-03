document.getElementById('registerForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = {
        name: document.getElementById('name').value,
        email: document.getElementById('email').value,
        password: document.getElementById('password').value,
        password_confirmation: document.getElementById('password_confirmation').value
    };

    try {
        const response = await fetch('/api/register', {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData)
        });

        const data = await response.json();

        if (response.ok && data.status === 'success') {
            localStorage.setItem('api_token', data.data.token);
            localStorage.setItem('user', JSON.stringify(data.data.user));
            window.location.href = '/';
        } else {
            const errors = data.errors || {};
            let errorMsg = data.message || 'Erro ao registrar';
            if (Object.keys(errors).length > 0) {
                errorMsg = Object.values(errors).flat().join('\n');
            }
            alert(errorMsg);
        }
    } catch (error) {
        alert('Erro ao registrar');
    }
});

