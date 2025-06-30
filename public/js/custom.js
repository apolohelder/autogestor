// Evento acionado ao clicar no botão de criar categoria.
// Valida se o campo de nome está preenchido e, em seguida, envia uma requisição AJAX via POST
// para a rota fornecida dinamicamente via atributo `data-url`. 
// A requisição inclui o nome da nova categoria e o token CSRF.
// Em caso de sucesso, a nova categoria é adicionada dinamicamente no início da lista de categorias
// com um checkbox já marcado. Também exibe mensagens de feedback para o usuário.
// Em caso de erro de validação (HTTP 422), exibe a mensagem retornada.
// Para outros erros, exibe uma mensagem genérica de falha na criação.

$('#create_category_btn').on('click', function () {
    const name = $('#new_category').val().trim();
    const feedback = $('#category_feedback');
    const url = $(this).data('url');

    if (!name) {
        feedback.text('Informe um nome de categoria.').css('color', 'red');
        return;
    }

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            name: name,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.success) {
                $('#category-list').prepend(`
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="categories[]" 
                            id="category_${response.category.id}" value="${response.category.id}" checked>
                        <label class="form-check-label" for="category_${response.category.id}">
                            ${response.category.name}
                        </label>
                    </div>
                `);
                $('#new_category').val('');
                feedback.text('Categoria criada com sucesso!').css('color', 'green');
            }
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                if (errors.name) {
                    feedback.text(errors.name[0]).css('color', 'red');
                }
            } else {
                feedback.text('Erro ao criar categoria.').css('color', 'red');
            }
        }
    });
});
//end

// Evento acionado ao clicar no botão de criar marca
$('#create_brand_btn').on('click', function () {
    const name = $('#new_brand').val().trim();
    const feedback = $('#brand_feedback');
    const url = $(this).data('url');

    if (!name) {
        feedback.text('Informe um nome para a marca.').css('color', 'red');
        return;
    }

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            name: name,
            _token: $('meta[name="csrf-token"]').attr('content')
        },
        success: function (response) {
            if (response.success) {
                // Adiciona a nova marca ao select
                $('#brand_id').append(new Option(response.brand.name, response.brand.id, true, true));

                // Atualiza o select para mostrar a nova marca selecionada
                $('#brand_id').val(response.brand.id).trigger('change');

                // Feedback visual para o usuário
                feedback.text('Marca criada com sucesso!').css('color', 'green');
                $('#new_brand').val(''); // Limpa o campo de input
            }
        },
        error: function (xhr) {
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                if (errors.name) {
                    feedback.text(errors.name[0]).css('color', 'red');
                }
            } else {
                feedback.text('Erro ao criar marca.').css('color', 'red');
            }
        }
    });
});


$(document).ready(function () {
    // Função de Máscara para Telefone
    $('.telefone').on('input', function () {
        // Remove tudo o que não é dígito
        let numero = $(this).val().replace(/\D/g, '');

        // Limita a 13 dígitos
        numero = numero.substring(0, 11);

        // Aplica a máscara conforme o tamanho do número
        if (numero.length <= 10) {
            // Formato para telefone fixo: (00) 0000-0000
            $(this).val(numero.replace(/(\d{2})(\d{4})(\d{0,4})/, '($1) $2-$3'));
        } else {
            // Formato para celular: (00) 00000-0000
            $(this).val(numero.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3'));
        }
    });

    //------------------------------------------
    // Alterna entre mostrar e esconder
    let expandido = localStorage.getItem("menuExpandido") === "true";

    // Aplica a classe correta ao carregar a página
    if (expandido) {
        $(".sidebar").addClass("expandido").removeClass("reduzido");

        $(".painel").addClass("reduzido").removeClass("expandido");
    } else {
        $(".sidebar").addClass("reduzido").removeClass("expandido");
        $(".painel").addClass("expandido").removeClass("reduzido");
    }

    $("#btn-toggle").click(function () {
        $(".sidebar").toggleClass("expandido reduzido");
        $(".painel").toggleClass("expandido reduzido");
        expandido = !expandido;
        localStorage.setItem("menuExpandido", expandido);
    });

    //------------------------------------------
    //Método para lidar com a remoção da foto de perfil
    var $photoContainer = $('#photo-container');
    var $uploadContainer = $('#upload-container');
    var $removePhotoBtn = $('#remove-photo-btn');
    var $removePhotoInput = $('#remove_photo');
    var $fileInput = $('#profile_photo');

    // Função para remover a foto
    if ($removePhotoBtn.length) {
        $removePhotoBtn.on('click', function () {
            // Esconde a foto e mostra o input
            $photoContainer.addClass('d-none');
            $uploadContainer.removeClass('d-none');

            // Marca que a foto deve ser removida
            $removePhotoInput.val('1');
        });
    }

    // Se o usuário selecionar uma nova foto
    if ($fileInput.length) {
        $fileInput.on('change', function () {
            $removePhotoInput.val('0');
        });
    }

    //------------------------------------------
    $("#multi-filter-select").DataTable({
        pageLength: 5,
        initComplete: function () {
            this.api()
                .columns()
                .every(function () {
                    var column = this;
                    var select = $(
                        '<select class="form-select"><option value=""></option></select>'
                    )
                        .appendTo($(column.footer()).empty())
                        .on("change", function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column
                                .search(val ? "^" + val + "$" : "", true, false)
                                .draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function (d, j) {
                            select.append(
                                '<option value="' + d + '">' + d + "</option>"
                            );
                        });
                });
        },
    });
});



// Desabilitar envios de formulários se houver campos inválidos
(() => {
    'use strict'

    // Busque todos os formulários aos quais desejamos aplicar estilos de validação Bootstrap personalizados
    const forms = document.querySelectorAll('.needs-validation')

    // Faça um loop sobre eles e evite a submissão
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
            }

            form.classList.add('was-validated')
        }, false)
    })
})()

