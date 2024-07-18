<?php

namespace Database\Seeders;

use App\Models\TipoServico;
use Illuminate\Database\Seeder;

class TiposServicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TipoServico::create([
            'codigo' => '100000001',
            'tipo' => 'Limpeza, conservação ou zeladoria'
        ]);

        TipoServico::create([
            'codigo' => '100000002',
            'tipo' => 'Vigilância ou segurança'
        ]);
          
          TipoServico::create([
            'codigo' => '100000003',
            'tipo' => 'Construção civil'
        ]);

        TipoServico::create([
            'codigo' => '100000004',
            'tipo' => 'Serviços de natureza rural'
          ]);
          
        TipoServico::create([
            'codigo' => '100000005',
            'tipo' => 'Digitação'
        ]);
          
        TipoServico::create([
            'codigo' => '100000006',
            'tipo' => 'Preparação de dados para processamento'
        ]);
          
        TipoServico::create([
            'codigo' => '100000007',
            'tipo' => 'Acabamento'
        ]);
          
        TipoServico::create([
            'codigo' => '100000008',
            'tipo' => 'Embalagem'
        ]);
          
        TipoServico::create([
            'codigo' => '100000009',
            'tipo' => 'Acondicionamento'
        ]);
          
        TipoServico::create([
            'codigo' => '100000010',
            'tipo' => 'Cobrança'
        ]);
          
        TipoServico::create([
            'codigo' => '100000011',
            'tipo' => 'Coleta ou reciclagem de lixo ou de resíduos'
        ]);
          
        TipoServico::create([
            'codigo' => '100000012',
            'tipo' => 'Copa'
        ]);
          
        TipoServico::create([
            'codigo' => '100000013',
            'tipo' => 'Hotelaria'
        ]);
          
        TipoServico::create([
            'codigo' => '100000014',
            'tipo' => 'Corte ou ligação de serviços públicos'
        ]);
          
        TipoServico::create([
            'codigo' => '100000015',
            'tipo' => 'Distribuição'
        ]);
          
        TipoServico::create([
            'codigo' => '100000016',
            'tipo' => 'Treinamento e ensino'
        ]);
          
        TipoServico::create([
            'codigo' => '100000017',
            'tipo' => 'Entrega de contas e de documentos'
        ]);
          
        TipoServico::create([
            'codigo' => '100000018',
            'tipo' => 'Ligação de medidores'
        ]);
          
        TipoServico::create([
            'codigo' => '100000019',
            'tipo' => 'Leitura de medidores'
        ]);
          
        TipoServico::create([
            'codigo' => '100000020',
            'tipo' => 'Manutenção de instalações, de máquinas ou de equipamentos'
        ]);
          
        TipoServico::create([
            'codigo' => '100000021',
            'tipo' => 'Montagem'
        ]);
          
        TipoServico::create([
            'codigo' => '100000022',
            'tipo' => 'Operação de máquinas, de equipamentos e de veículos'
        ]);
          
        TipoServico::create([
            'codigo' => '100000023',
            'tipo' => 'Operação de pedágio ou de terminal de transporte'
        ]);
          
        TipoServico::create([
            'codigo' => '100000024',
            'tipo' => 'Operação de transporte de passageiros'
        ]);
          
        TipoServico::create([
            'codigo' => '100000025',
            'tipo' => 'Portaria, recepção ou ascensorista'
        ]);
          
        TipoServico::create([
            'codigo' => '100000026',
            'tipo' => 'Recepção, triagem ou movimentação de materiais'
        ]);
          
        TipoServico::create([
            'codigo' => '100000027',
            'tipo' => 'Promoção de vendas ou de eventos'
        ]);
          
        TipoServico::create([
            'codigo' => '100000028',
            'tipo' => 'Secretaria e expediente'
        ]);
          
        TipoServico::create([
            'codigo' => '100000029',
            'tipo' => 'Saúde'
        ]);
          
        TipoServico::create([
            'codigo' => '100000030',
            'tipo' => 'Telefonia ou telemarketing'
        ]);

        TipoServico::create([
            'codigo' => '100000031',
            'tipo' => 'Trabalho temporário na forma da Lei nº 6.019, de janeiro de 1974'
        ]);
    }
}
