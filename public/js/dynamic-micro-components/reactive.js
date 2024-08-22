/**
 * Esse método faz uma chamada assíncrona ao banco de dados de acordo com a URL
 * e os parâmetros passados no chamada do método. O retorno é o JSON retornado pelo
 * back-end que pode ser de sucesso ou falha.
 * 
 * @param {string} url 
 * @param  {...any} params 
 * @returns um json do backend
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
 * Esse método recebe uma URL e uma query string apenas.
 * Ambas são concatenadas e enviadas em uma chamada método call() sem parâmetros.
 * Dessa forma, é possível fazer uma requisição ao back-end usando query params
 * para buscar resultados de forma mais dinâmica. 
 * 
 * @param {*} url 
 * @param {*} queryString 
 */
export async function query(url, queryString){
    call(`${url}?${queryString}`);
}

export async function deliver(url, payload){
    try {
        const response = await fetch(`${url}`, {
            method: 'POST',
            headers: {
                'Content-Type' : 'application/json'
            },
            body: JSON.stringify(payload)
        });
        return response.json();
    } catch (error) {
        console.error('Erros encontrados : ', error);
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
    return function() {
        const context = this;
        const args = arguments;
        clearTimeout(timeout);
        timeout = setTimeout(() => {
            func.apply(context, args);
        }, wait);
    };
}

/**
 * 
 * @param {*} func a função que será limitada
 * @param {*} limit o tempo de limitação em ms
 * @returns 
 */
export function throttle(func, limit){
    let inThrottle = false;
    return function () {
        const args = arguments;
        const context = this;
        if(!inThrottle){
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    }
}