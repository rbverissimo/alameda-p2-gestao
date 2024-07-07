<script type="module">
    const dominio = @json($dominio);
    const appData = @json($appData);
    const appDataEvent = new CustomEvent("appData", {
        detail: appData 
    });
    appDataEvent.dominio = dominio;

    document.addEventListener('DOMContentLoaded', () => {
        document.dispatchEvent(appDataEvent);
    });

</script>