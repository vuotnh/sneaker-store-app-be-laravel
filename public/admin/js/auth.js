// $(document).ready(function () {});

function validateOnSubmit(form, fields) {
    form.addEventListener("submit", function login(event) {
        event.preventDefault();
        let error = 0;
        let formData = {};
        fields.forEach((field) => {
            const input = document.querySelector(`#${field}`);
            formData[field] = input.value.trim();
        })
        const options = {
            method: 'POST',
            headers: {
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(formData),
        }

        fetch('http://localhost:8082/auth/login', options)
            .then((response) => {
                if (response.ok) {
                    return response.json();
                }
                return Promise.reject(response);
            })
            .then((data) => {
                localStorage.setItem('access_token', data.access_token);
                localStorage.setItem('expired_in', data.expires_in);
                form.submit();
            })

        // clear event listener
        form.removeEventListener("submit", login);
    })
}


const form = document.querySelector('.loginForm');


if (form) {
    const fields = ["email", "password"];
    validateOnSubmit(form, fields);
}

