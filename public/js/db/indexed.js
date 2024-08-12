import { logarErro } from "../validators/log-erros.js";

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

export async function getIDBInput(dbName, storeName){
    
}