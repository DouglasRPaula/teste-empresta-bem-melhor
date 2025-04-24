<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class LoanController extends BaseController
{
    private function getJsonData($filename) {
        $path = storage_path("app/dados/{$filename}");
        if (!file_exists($path)) {
            return [];
        }
        return json_decode(file_get_contents($path), true);
    }

    public function instituicoes() {
        $instituicoes = $this->getJsonData("instituicoes.json");
        return response()->json(
            array_column($instituicoes, 'valor', 'chave')
        );
    }

    public function convenios() {
        $convenios = $this->getJsonData("convenios.json");
        return response()->json(
            array_column($convenios, 'valor', 'chave')
        );
    }

    public function simular(Request $request) {
        $validated = $request->validate([
            'valor_emprestimo' => 'required|numeric|min:0',
            'instituicoes' => 'sometimes|array',
            'convenios' => 'sometimes|array',
            'parcela' => 'sometimes|integer|min:1'
        ]);

        $taxas = $this->getJsonData("taxas_instituicoes.json");

        $resultado = [];

        foreach ($taxas as $taxa) {
            // Aplicar filtros
            if (!empty($validated['instituicoes']) &&
                !in_array($taxa['instituicao'], $validated['instituicoes'])) {
                continue;
            }

            if (!empty($validated['convenios']) &&
                !in_array($taxa['convenio'], $validated['convenios'])) {
                continue;
            }

            if (isset($validated['parcela']) && $taxa['parcelas'] != $validated['parcela']) {
                continue;
            }

            // Calcular parcela
            $valorParcela = $validated['valor_emprestimo'] * $taxa['coeficiente'];

            $resultado[] = [
                'instituicao' => $taxa['instituicao'],
                'convenio' => $taxa['convenio'],
                'parcelas' => $taxa['parcelas'],
                'valor_parcela' => round($valorParcela, 2),
                'taxa_juros' => $taxa['taxaJuros'],
                'coeficiente' => $taxa['coeficiente']
            ];
        }

        return response()->json($resultado);
    }
}
