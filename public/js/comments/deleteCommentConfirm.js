document.addEventListener('DOMContentLoaded', function() {
    let botoesExcluir = document.querySelectorAll('.delete-comment-button');
    
    botoesExcluir.forEach(function(botao) {
        botao.addEventListener('click', function(event) {
            event.preventDefault();
            let commentId = botao.getAttribute('data-id');
            
            Swal.fire({
                title: 'Você tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir comentário!',
                cancelButtonText: 'Não, cancelar!',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Excluído!',
                        'Seu comentário foi excluído.',
                        'success'
                    );
                    setTimeout(function() {
                        window.location.href = '/comment/delete/' + commentId;
                    }, 1500);
                }
            });
        });
    });
});
