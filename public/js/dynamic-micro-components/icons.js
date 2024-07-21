export function gerarDeletarButton(text = 'Deletar'){
    const button = document.createElement('button');
    button.classList.add('button');
    button.classList.add('deletar-button');
    button.textContent = text;
    return button;

}