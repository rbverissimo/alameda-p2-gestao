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

      @isset($comprovante)
      <div>
            <div>
                  @component('app.layouts._components.form_comprovantes_transf', 
                  compact('tipos_comprovantes', 'comprovante', 'mensagem'))
                  @endcomponent
            </div>
      </div>
      @endisset
@endsection

@include('app.scripts.script-comprovantes')