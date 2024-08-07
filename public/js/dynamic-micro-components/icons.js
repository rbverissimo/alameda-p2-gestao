export function gerarDeletarButton(text = 'Deletar'){
    const button = document.createElement('button');
    button.classList.add('button');
    button.classList.add('deletar-button');
    button.textContent = text;
    return button;
}

export function gerarInfoButton(text = 'Info'){
    const button = document.createElement('button');
    button.classList.add('button');
    button.classList.add('info-button');
    button.textContent = text;
    return button;
}