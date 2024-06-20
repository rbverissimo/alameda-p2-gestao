<div id="mensagem-container">
      <div id="neutra-mensagem"></div>
      <div id="sucesso-mensagem"></div>
      <div id="falha-mensagem"></div>
</div>

{{--  Essa div recolhe erros que venham na session. 
      Esses erros podem acontecer pelos mais variados motivos: 
      desde erros de validação de dados até erros na própria da API      
--}}
@if (Session::has('erros'))
        <div id="mensagem-erro-session" style="display: none">
            {{ Session::get('erros') }}
        </div>
@endif
