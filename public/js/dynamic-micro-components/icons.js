export function gerarDeleteIcon(){
    const img = document.createElement('img');
    img.classList.add('delete-icon');
    img.alt = 'EXCLUIR';

    const span = document.createElement('span');
    span.classList.add('bg-del-icon');
    span.appendChild(img);

    return span;

}