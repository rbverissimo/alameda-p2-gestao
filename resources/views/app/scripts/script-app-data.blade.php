<script type="module">
    const appData = @json($appData);
    const appDataEvent = new CustomEvent("appData", {
        detail: appData['appData']
    });
    appDataEvent.dominio = appData['dominio'];
    document.addEventListener('DOMContentLoaded', () => {
        document.dispatchEvent(appDataEvent);
    });

</script>