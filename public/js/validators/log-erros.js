import { deliver } from "../dynamic-micro-components/reactive.js";
import { LOG_ERROS } from "../routes.js";

export async function logarErro(data, json = ''){
    const payload = {
        'rota': window.location.pathname,
        'log' : data,
        'json' : json,    
    }
    const reponse = await deliver(LOG_ERROS, payload);
}