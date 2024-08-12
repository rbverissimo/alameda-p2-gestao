import { logarErro } from "../validators/log-erros.js";
import { isStrValueNuloOuVazio } from "../validators/null-safe.js";

export async function iniciarObjectStores(dbName, ...stores){
    const request = indexedDB.open(dbName, 1);
    request.onupgradeneeded = (event) => {
        const db = event.target.result;
        stores.forEach(store => {
            db.createObjectStore(store, {autoIncrement: true});
        });
    }
}

export async function salvarIDBInput(dbName, storeName, inputName, inputValue){
    const request = indexedDB.open(dbName, 1);

    request.onsuccess = (event) => {
        const db = event.target.result;
        const transaction = db.transaction(storeName, 'readwrite');
        const objectStore = transaction.objectStore(storeName);
        
        const data = {
            name: inputName,
            value: inputValue
        }

        const request = objectStore.add(data);

        request.onerror = (event) => {
            const erro = event.target.error;
            logarErro(erro, data);
        }

    }
}

export async function getStoredValue(dbName, storeName){
    return new Promise((resolve, reject) => {
        const request = indexedDB.open(dbName, 1);
        request.onerror = (event) => {
            reject(event.error);
        };

        request.onsuccess = (event) => {
            const db = event.target.result;
            const transaction = db.transaction(storeName, 'readonly');
            const objectStore = transaction.objectStore(storeName);

            const keyRange = IDBKeyRange.upperBound(Number.MAX_SAFE_INTEGER);
            const cursorRequest = objectStore.openCursor(keyRange, 'prev');

            cursorRequest.onsuccess = (event) => {
                const cursor = event.target.result;
                if(cursor){
                    resolve(cursor.value);
                } else {
                    resolve(null);
                }
            };
            cursorRequest.onerror = (event) => {
                reject(event.error);
            };
        };
    });
}

/**
 * 
 * @param {*} dbName 
 * @param {*} storeName 
 * @param {*} concreteInput 
 * @param {*} masking 
 * @param {*} maskHandler 
 */
export async function getInputValueFromIDB(dbName, storeName, concreteInput, masking = false, maskHandler = null){
    if(isStrValueNuloOuVazio(concreteInput.value)){
        const stored = await getStoredValue(dbName, storeName);
        if(stored !== null){
            concreteInput.value = stored.value;
            if(masking){
                concreteInput.value = maskHandler(concreteInput.value);
            }
        }
    } 
}

export async function existeDb(dbName){
    return new Promise((resolve, reject) => {
        const request = db.open(dbName);
        request.onsuccess = (event) => {
            resolve(true);
        };
        request.onerror = (event) => {
            if(event.target.error.name === 'InvalidAccessError'){
                resolve(false);
            } else {
                reject(event.target.error);
            }
        };
        request.onupgradeneeded = (event) => {
            resolve(false);
        }
    });
}