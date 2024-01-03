@extends('app.layouts.template-basico')

@section('conteudo')

@isset($inquilino)
      <div>{{$inquilino->nome}}</div>
@endisset

@endsection