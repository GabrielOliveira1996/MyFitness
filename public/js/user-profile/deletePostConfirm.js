function deletePost() {
    let botoesExcluir = document.querySelectorAll('.delete-post-button');
    
    botoesExcluir.forEach(function(botao) {
        botao.addEventListener('click', function(event) {
            event.preventDefault();
            let postId = botao.getAttribute('data-id');
            
            Swal.fire({
                title: 'Você tem certeza?',
                text: "Você não poderá reverter isso!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir post!',
                cancelButtonText: 'Não, cancelar!',
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Excluído!',
                        'Seu post foi excluído.',
                        'success'
                    );
                    setTimeout(function() {
                        window.location.href = '/post/delete/' + postId;
                    }, 1500);
                }
            });
        });
    });
};
