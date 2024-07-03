<form action="" method="GET">
    @csrf
    @component('app.layouts._components.dados_fornecedor', compact('fornecedor'))
        
    @endcomponent

</form>