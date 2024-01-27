@extends('app.layouts.template-basico')

@section('conteudo')
<h4>Declare um comprovante </h4>
      @isset($inquilinos)
      <div>
            <div>
                  @component('app.layouts._components.form_comprovantes_transf',
                  compact('inquilinos', 'tipos_comprovantes'))
                  @endcomponent
            </div>
      </div>
      @endisset

      @isset($id)
      <div>
            <div>
                  @component('app.layouts._components.form_comprovantes_transf', 
                  compact('tipos_comprovantes', 'id', 'comprovante'))
                  @endcomponent
            </div>
      </div>
      @endisset
@endsection