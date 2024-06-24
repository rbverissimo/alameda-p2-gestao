<form action="" method="post">
    @csrf
    @component('app.layouts._components.dados_compra', compact('input_autocomplete', 'placeholder'))
        
    @endcomponent
</form>