const { createApp } = Vue;

createApp({
    el: '#vue-user-logout',
    data() {
        return {}
    },
    methods: {
        logout(){
            localStorage.removeItem('token');
        }
    },
}).mount('#vue-user-logout');





