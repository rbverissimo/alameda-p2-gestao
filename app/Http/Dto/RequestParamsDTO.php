<?php

namespace App\Http\Dto;

use Illuminate\Http\Request;

class RequestParamsDTO {

    private array $inputs;
    private array $headers;
    private string $url;
    private string $metodo;

    public function __construct(Request $request) {
        $this->inputs = $request->all();
        $this->headers = $request->headers->all();
        $this->url = $request->url();
        $this->metodo = $request->method();
    }

    public function getInputs(): array 
    {
        return $this->inputs;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    } 

    public function getUrl(): string 
    {
        return $this->url;
    }

    public function getMetodo(): string
    {
        return $this->metodo;
    }

}