<div id="mensagem-container">
      <div id="neutra-mensagem"></div>
      <div id="sucesso-mensagem"></div>
      <div id="falha-mensagem"></div>
</div>

@if (Session::has('erros'))
        <div id="mensagem-erro-session" style="display: none">
            {{ Session::get('erros') }}
        </div>
@endif
