
const wrapperSalas = document.getElementById('wrapper-salas');
const adicionarSalaButton = document.getElementById('adicionar-sala-button');

const tiposOptions = [
    { value: "1", text: 'Residencial' },
    { value: "2", text: 'Comercial' },
    { value: "3", text: 'Rural' },
];

let salasCounter = 2;

document.addEventListener('DOMContentLoaded', () => {
    adicionarSalaButton.addEventListener('click', adicionarCamposNovaSala);
});


function adicionarCamposNovaSala(event){
    const novaRow = document.createElement('div');
    novaRow.id = 'row-sala-form-' + getCounter();
    novaRow.classList.add('row');
    
    const col7 = document.createElement('div');
    col7.classList.add('col-7');
    novaRow.appendChild(col7);
    
    const inputSala = document.createElement('input');
    inputSala.name = 'input-sala-form-nome-' + getCounter();
    inputSala.placeholder = 'Digite aqui o nome da sala' 
    col7.appendChild(inputSala);
    
    const col3 = document.createElement('div')
    col3.classList.add('col-3');
    novaRow.appendChild(col3);

    criarSelect(col3);
    
    const col2 = document.createElement('div');
    col2.classList.add('col-2');
    novaRow.appendChild(col2);


    const imgDelete = document.createElement('img');
    imgDelete.src = '../public/icons/delete-icon.svg';
    imgDelete.alt = 'EXCLUIR';
    col2.appendChild(imgDelete);
    
    wrapperSalas.appendChild(novaRow);
    
    updateCounter();
    adicionarImgDeleteEventListener(imgDelete);
    event.preventDefault();

}

function getCounter() {
    return salasCounter;
}

function updateCounter(){
    salasCounter++;
}

function criarSelect(node){
    const tipoContaSelect = document.createElement('select');

    tipoContaSelect.id = '';
    tipoContaSelect.name = 'select-sala-form-tipo-' + getCounter(); 

    for(const option of tiposOptions){
        const novaOption = document.createElement('option');
        novaOption.value = option.value;
        novaOption.textContent = option.text;

        tipoContaSelect.appendChild(novaOption);
    }

    node.appendChild(tipoContaSelect);
}

function adicionarImgDeleteEventListener(imgDelete){
    imgDelete.addEventListener('click', eliminarSala);
}

function eliminarSala(event){
    const divCol2 = event.target.parentElement;
    const divRow = divCol2.parentElement;
    if(divRow){
        divRow.remove();
    }
}


{/* <div class="row">
            <div class="col-7">
                <input type="text" name="input-sala-form-nome-1" placeholder="Digite aqui o nome da sala ">
            </div>
            <div class="col-3">
                <select name="input-sala-form-tipo-1" id="">
                    <option value="1">Residencial</option>
                    <option value="2">Comercial</option>
                    <option value="3">Rural</option>
                </select>
            </div>
            <div class="col-2">
                <img src="{{asset("icons/delete-icon.svg")}}" alt="EXCLUIR">
            </div>
        </div> */}