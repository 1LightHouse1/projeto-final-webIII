document.getElementById('loginForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const formData = {
        email: document.getElementById('email').value,
        password: document.getElementById('password').value
    };

    try {
        const response = await fetch('/api/login', {
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
            alert(data.message || 'Erro ao fazer login');
        }
    } catch (error) {
        alert('Erro ao fazer login');
    }
});

