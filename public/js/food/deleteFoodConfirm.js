document.addEventListener('DOMContentLoaded', function() {
    let botoesExcluir = document.querySelectorAll('.delete-food-button');
    
    botoesExcluir.forEach(function(botao) {
        botao.addEventListener('click', function(event) {
            event.preventDefault();
            let foodId = botao.getAttribute('data-id');
            
            Swal.fire({
                title: 'Você tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir alimento!',
                cancelButtonText: 'Não, cancelar!',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Excluído!',
                        'Seu alimento foi excluído.',
                        'success'
                    );
                    setTimeout(function() {
                        window.location.href = '/food/delete/' + foodId;
                    }, 2000);
                }
            });
        });
    });
});
