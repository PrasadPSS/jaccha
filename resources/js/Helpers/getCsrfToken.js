let csrfToken = null;

export async function getCsrfToken() {
    if (!csrfToken) {
        // Fetch a new CSRF token if it's not already set
        const response = await fetch('/refresh-csrf', {
            method: 'GET',
            credentials: 'same-origin',
        });
        if (response.ok) {
            const data = await response.json();
            csrfToken = data.csrf_token;
        } else {
            throw new Error('Failed to fetch CSRF token');
        }
    }
    return csrfToken;
}
