const { createApp } = Vue;

createApp({
    el: "#app",
    data() {
        return {
            cards: [
                { isEnlarged: false },
                { isEnlarged: false },
                { isEnlarged: false },
                { isEnlarged: false },
                { isEnlarged: false },
                { isEnlarged: false },
                { isEnlarged: false },
                { isEnlarged: false },
                { isEnlarged: false },
                { isEnlarged: false },
            ], 
        };
    },
    methods: {
        toggleEnlarged(index) {
            this.cards[index].isEnlarged = !this.cards[index].isEnlarged; // Alterna entre aumentado e não aumentado
            console.log(this.cards[index].isEnlarged);
        },
    }
}).mount("#app");