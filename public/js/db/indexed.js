export function saveInput(dbName, storeName, inputName, inputValue){
    const request = indexedDB.open(dbName, 1);

    request.onsuccess = (event) => {

    }

    const data = {
        name: inputName,
        value: inputValue
    }
}