@extends('app.layouts.template-basico')

@section('conteudo')
<h4>Declare um comprovante </h4>
      <div>
            <div>
                  @component('app.layouts._components.form_comprovantes_transf',
                  compact('inquilinos', 'tipos_comprovantes'))
                  @endcomponent
            </div>
      </div>
@endsection