<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Cliente;

class Validate extends Model
{
    use HasFactory;

    public function validaEmail($email)
        {
            return filter_var($email, FILTER_VALIDATE_EMAIL) ? true : false;
        }
        public function formataDataAmericano($data)
        {
            $data = explode("/", $data);
            $data = $data[2] . "-" . $data[1] . "-" . $data[0];
            return $data;
        }

        public function formataDataBrasileiro($data)
        {
            $data = explode("-", $data);
            $data = $data[2] . "/" . $data[1] . "/" . $data[0];
            return $data;
        }

        public function formataCpf($cpf) {
            return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cpf);
        }
        
        public function validaCPF($cpf)
        {
            // Verifica se um número foi informado
            if (empty($cpf)) {
                return false;
            }

            //Remove tudo que não é número do CPF
            $cpf = preg_replace("/[^0-9]/", "", $cpf);

            // Verifica se o numero de digitos informados é igual a 11
            if (strlen($cpf) != 11) {
                return false;
            }
            // Verifica se nenhuma das sequências invalidas abaixo
            // foi digitada. Caso afirmativo, retorna falso
            else if (
                $cpf == '00000000000' ||
                $cpf == '11111111111' ||
                $cpf == '22222222222' ||
                $cpf == '33333333333' ||
                $cpf == '44444444444' ||
                $cpf == '55555555555' ||
                $cpf == '66666666666' ||
                $cpf == '77777777777' ||
                $cpf == '88888888888' ||
                $cpf == '99999999999'
            ) {
                return false;
                // Calcula os digitos verificadores para verificar se o
                // CPF é válido
            } else {

                for ($t = 9; $t < 11; $t++) {

                    for ($d = 0, $c = 0; $c < $t; $c++) {
                        $d += $cpf[$c] * (($t + 1) - $c);
                    }
                    $d = ((10 * $d) % 11) % 10;
                    if ($cpf[$c] != $d) {
                        return false;
                    }
                }
                return true;
            }
        }

        public function emailExiste($email)
        {
            $cliente = Cliente::where('email', $email)->first();
            if ($cliente) {
                return true;
            } else {
                return false;
            }
        }

        public function cpfExiste($cpf)
        {
            $cliente = Cliente::where('cpf', $cpf)->first();
            if ($cliente) {
                return true;
            } else {
                return false;
            }
        }


}
