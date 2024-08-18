

export function toggleModalPicker(patternName){
    const overlay = `modal-overlay-${patternName}`;
    const dashboard = `modal-dashboard-${patternName}`;

    const overlayEl = document.getElementById(overlay);
    const dashboardEl = document.getElementById(dashboard);

    overlayEl.style.display = overlayEl.style.display === 'none' || overlayEl.style.display === '' ? 'block' : 'none';
    dashboardEl.style.display = dashboardEl.style.display === 'none' || dashboardEl.style.display === '' ? 'block' : 'none';
}

export function getModalTable(patternName){
    return document.getElementById(`modal-table-${patternName}`);
}

export function onPickedSelection(data, dispatch = true){
    const event = new CustomEvent('onPickedSelection', {
        detail: data
    });

    if(dispatch){
        document.dispatchEvent(event);
    }
}