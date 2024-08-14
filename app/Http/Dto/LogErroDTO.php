<?php

namespace App\Http\Dto;

class LogErroDTO {

    private int $usuario;
    private string $rota;
    private string $json;
    private string $log;
    private ?string $verbo_http;
    private ?string $request_headers;

    public function __construct(int $usuario, string $rota, string $json, string $log, string $verbo_http = null, string $request_headers = null) {
        $this->usuario = $usuario;
        $this->rota = $rota;
        $this->json = $json;
        $this->log = $log;
        $this->verbo_http = $verbo_http;
        $this->request_headers = $request_headers;
    }

    // Getters
    public function getUsuario(): int
    {
        return $this->usuario;
    }

    public function getRota(): string
    {
        return $this->rota;
    }

    public function getJson(): string
    {
        return $this->json;
    }

    public function getLog(): string
    {
        return $this->log;
    }

    public function getVerboHttp(): ?string
    {
        return $this->verbo_http;
    }

    public function getRequest(): ?string
    {
        return $this->request_headers;
    }

    // Setters
    public function setUsuario(int $usuario): void
    {
        $this->usuario = $usuario;
    }

    public function setRota(string $rota): void
    {
        $this->rota = $rota;
    }

    public function setJson(string $json): void
    {
        $this->json = $json;
    }

    public function setLog(string $log): void
    {
        $this->log = $log;
    }

    public function setVerboHttp(?string $verbo_http): void 
    {
        $this->verbo_http = $verbo_http;
    }

    public function setRequest(?string $request_headers): void 
    {
        $this->request_headers = $request_headers;
    }

}