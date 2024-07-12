<?php

namespace App\ValueObjects;

class SituacaoFinanceiraVO {
      
      public int $referencia;
      public float $saldo_atual;
      public string $data_ultimo_saldo_atual;
      public float $saldo_parcial;
      public float $aluguel;
      public float $total_contas_mensais;
      public array $contas_inquilino;
      public bool $is_saldo_defasado;

      public function getReferencia(): int
      {
            return $this->referencia;
      }

      public function getSaldoAtual(): float
      {
            return $this->saldo_atual;
      }

      public function getDataUltimoSaldoAtual(): string
      {
            return $this->data_ultimo_saldo_atual;
      }

      public function getSaldoParcial(): float
      {
            return $this->saldo_parcial;
      }

      public function getAluguel(): float
      {
            return $this->aluguel;
      }

      public function getTotalContasMensais(): float
      {
            return $this->total_contas_mensais;
      }

      public function getContasInquilino(): array
      {
            return $this->contas_inquilino;
      }

      public function isSaldoDesafado(): bool
      {
            return $this->is_saldo_defasado;
      }

      public function setReferencia(int $referencia): void
      {
            $this->referencia = $referencia;
      }

      public function setSaldoAtual(float $saldoAtual): void
      {
            $this->saldo_atual = $saldoAtual;
      }

      public function setDataUltimoSaldoAtual(string $dataUltimoSaldoAtual): void
      {
            $this->data_ultimo_saldo_atual = $dataUltimoSaldoAtual;
      }

      public function setSaldoParcial(float $saldoParcial): void
      {
            $this->saldo_parcial = $saldoParcial;
      }

      public function setAluguel(float $aluguel): void
      {
            $this->aluguel = $aluguel;
      }

      public function setTotalContasMensais(float $totalContasMensais): void
      {
            $this->total_contas_mensais = $totalContasMensais;
      }

      public function setContasInquilino(array $contasInquilino): void
      {
            $this->contas_inquilino = $contasInquilino;
      }

      public function setIsSaldoDefasado(bool $is_saldo_defasado): void
      {
            $this->is_saldo_defasado = $is_saldo_defasado;
      }



}