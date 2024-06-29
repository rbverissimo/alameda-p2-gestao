export function apenasNumeros(event) {
            
    // Permissões
    if (event.key === "Backspace" || event.key === "Delete" || event.key === "ArrowLeft" || event.key === "ArrowRight"
          || event.key === "Tab" || event.key === "Escape" || event.key === "Enter") {
          return;
    }

    //Permissões para Ctrl+C Ctrl+A etc
    if ((event.ctrlKey === true || event.metaKey === true) 
          && ((event.key === "a" || event.key === "A") || (event.key === "c" || event.key === "C") 
          || (event.key === "v" || event.key === "V"))) {
          return;
    }

    if (!/^[0-9]$/.test(event.key)) {
          event.preventDefault();
    }
}

export function isDataValida(dateString) {
      const regex = /^\d{2}-\d{2}-\d{4}$/;
      if(!regex.test(dateString)){
            return false;
      }

      
      const month = parseInt(dateString.slice(3, 5), 10);
      const day = parseInt(dateString.slice(0, 2), 10);

      return month >= 1 && month <= 12 && day >= 1 && day <= 31;
}