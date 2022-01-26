const botaoIncluir = document.getElementById("incluir");
const campoCor = document.getElementById("cor");
const titulo = document.getElementById("titulo");
const campoBusca = document.getElementById("metodo");
const espacoBusca = document.getElementById("busca");
const buscaCor = document.getElementById("buscaCor");
const buscaPreco = document.getElementById("buscaPreco");
const buscaNome = document.getElementById("buscaNome");
const operador = document.getElementById("operador");


// Ativa o botão editar
function modoEdicao() {
    titulo.textContent = "EDITAR PRODUTO";
    campoCor.setAttribute("style", "color: black; width:177px;")
}

// Desabilita o campo cor 
function desabilitaAlteracaoDeCor() {
    campoCor.setAttribute("disabled", "");
    campoCor.placeholder = "Campo desabilitado";
}

// Função responsável por fazer o efeito de placeholder no select, em conjunto com o CSS
function alteraCor(sel) {
    sel.style.color = "black";
}

// Função responsável por alterar os modos de busca
campoBusca.addEventListener('change', modoDeBusca);

function modoDeBusca(evento){
    const modo = evento.target.value;

    if (modo == 'cor'){
        buscaCor.removeAttribute('hidden');
        buscaNome.setAttribute('hidden', '');
        buscaPreco.setAttribute('hidden', '');

    } else if (modo == 'preco'){
        buscaCor.setAttribute('hidden', '');
        buscaNome.setAttribute('hidden', '');
        buscaPreco.removeAttribute('hidden');
    } else if (modo == 'produto'){
        buscaNome.removeAttribute('hidden');
        buscaPreco.setAttribute('hidden', '');
        buscaCor.setAttribute('hidden', '');
    }
    
}