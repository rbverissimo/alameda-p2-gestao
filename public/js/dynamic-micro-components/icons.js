export function gerarDeletarButton(){
    const button = document.createElement('button');
    button.classList.add('button');
    button.classList.add('deletar-button');
    button.textContent = 'Deletar';
    return button;

}