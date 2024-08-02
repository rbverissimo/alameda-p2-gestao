/**
 * Esse método faz uma chamada assíncrona ao banco de dados de acordo com a URL
 * e os parâmetros passados no chamada do método. O retorno é o JSON retornado pelo
 * back-end que pode ser de sucesso ou falha.
 * 
 * @param {string} url 
 * @param  {...any} params 
 * @returns 
 */
export async function call(url, ...params){

    let pathUrl = url;

    if(params.length > 0){
        pathUrl = `${url}/${params.join('/')}`;
    } 

    try {
        const response = await fetch(`${pathUrl}`);
        const data = await response.json();
        
        if(!response.ok){
            const error = new Error(`Ocorreram erros de conexão com o servidor. Status: ${response.statusText}`);
            error.response = data.mensagem;
            throw error;
        }
        return data;
    } catch (error) {
        console.error('Erros encontrados: ', error.response);
        throw error;
    }

}

/**
 * 
 * @param {*} func um handler com argumentos
 * @param {number} wait o tempo em ms em que a função esperará para ser recuperada pelo timeout
 * @returns 
 */
export function debounce(func, wait){
    let timeout;
    clearTimeout(timeout);
    return function execute(...args){
        const later = () => {
            func(...args);
        };
        timeout = setTimeout(later, wait);
    };
}