const { createApp } = Vue;

createApp({
    el: "#settings",
    data(){
        return {
            image: null,
            imageInputId: null,
        };
    },
    methods: {
        changeImage(event){
            const file = event.target.files[0];
            if(file){
                if(file.size > 2097152 || file.type !== 'image/png' && file.type !== 'image/jpeg' && file.type !== 'image/jpg'){
                    $('#errorModal').modal('show');
                }else{
                    const reader = new FileReader();
                    reader.onload = () => {
                        this.image = reader.result;
                    }
                    reader.readAsDataURL(file);
                    $('#exampleModal').modal('show');
                }
            }
        },
        closeModal(){
            document.getElementById('imageInputId').value = '';
        }
    },
}).mount("#settings");