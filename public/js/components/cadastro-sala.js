
const wrapperSalas = document.getElementById('wrapper-salas');
const adicionarSalaButton = document.getElementById('adicionar-sala-button');

let salasCounter = 1;

document.addEventListener('DOMContentLoaded', () => {
    adicionarSalaButton.addEventListener('click', adicionarCamposNovaSala);
});


function adicionarCamposNovaSala(event){
    const novaRow = document.createElement('div');
    novaRow.classList.add('row');
    
    const col7 = document.createElement('div');
    col7.classList.add('col-7');
    novaRow.appendChild(col7);
    
    const inputSala = document.createElement('input');
    inputSala.name = 'input-sala-form-nome-' + salasCounter + 1;
    inputSala.placeholder = 'Digite aqui o nome da sala' 
    col7.appendChild(inputSala);
    salasCounter += 1;
    
    const col3 = document.createElement('div')
    col3.classList.add('col-3');
    novaRow.appendChild(col3);
    
    const col2 = document.createElement('div');
    col3.classList.add('col-2');
    novaRow.appendChild(col2);
    
    wrapperSalas.appendChild(novaRow);
    // Previne que o clique ative o submit do formulário
    event.preventDefault();

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