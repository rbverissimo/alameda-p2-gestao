<form action="" method="post" enctype="multipart/form-data">
    @csrf
    @component('apps.layouts._components.dados_contrato', compact('contrato'))
        
    @endcomponent
</form>