const { createApp } = Vue;

createApp({
    el: '#vue-user-login',
    data() {
        return {
            email: '',
            password: '',
            error: null,
        }
    },
    mounted(){

    },
    methods: {
        login() {
            const formData = new FormData();
            formData.append('email', this.email);
            formData.append('password', this.password);
            console.log(`${window.APP_URL}:8000/login`);
            if(window.APP_URL === 'http://localhost'){
                requestUrl = `${window.APP_URL}:8000/login`;
            }else{
                requestUrl = `${window.APP_URL}/login`;
            }
            axios.post(requestUrl, formData).then(response => {;
                if(response.data.error){ // Erro de autenticação.
                    this.error = response.data.error;
                }else{ // Sucesso ao tentar logar.
                    const token = 'Bearer ' + response.data.token;
                    localStorage.setItem('token', token);
                    window.location.href = '/';
                }
            }).catch(error => {
                console.error(error.response.data);
            });
        },
    },
}).mount('#vue-user-login');



