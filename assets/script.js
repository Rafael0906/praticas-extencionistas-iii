// Confirmação antes de excluir
function confirmarExclusao(id) {
    return confirm('Tem certeza que deseja excluir esta doação?');
}

// Máscara para data (dd/mm/aaaa)
function mascaraData(input) {
    let valor = input.value.replace(/\D/g, '');
    if (valor.length <= 2) {
        input.value = valor;
    } else if (valor.length <= 4) {
        input.value = valor.slice(0,2) + '/' + valor.slice(2);
    } else {
        input.value = valor.slice(0,2) + '/' + valor.slice(2,4) + '/' + valor.slice(4,8);
    }
}

// Validação de formulário
function validarDoacao(form) {
    let valor = form.valor.value;
    let tipo_item = form.tipo_item.value;
    let quantidade = form.quantidade.value;
    
    if (valor === '' && tipo_item === '') {
        alert('Preencha o valor da doação ou o tipo de item');
        return false;
    }
    
    if (tipo_item !== '' && quantidade === '') {
        alert('Informe a quantidade do item doado');
        return false;
    }
    
    return true;
}

// Pesquisa em tempo real
function pesquisarDoacoes() {
    let input = document.getElementById('pesquisa');
    let filtro = input.value.toUpperCase();
    let tabela = document.getElementById('tabelaDoacoes');
    let linhas = tabela.getElementsByTagName('tr');
    
    for (let i = 1; i < linhas.length; i++) {
        let texto = linhas[i].innerText.toUpperCase();
        if (texto.indexOf(filtro) > -1) {
            linhas[i].style.display = '';
        } else {
            linhas[i].style.display = 'none';
        }
    }
}