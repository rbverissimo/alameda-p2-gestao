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