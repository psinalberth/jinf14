<?php

class FormatterHelper extends AppHelper {
        
        public function porcentagem($dividendo, $divisor){
            
            if(!$dividendo)
                return 0;
            else
                return number_format( (($dividendo/$divisor)*100),2 );
        }
    
        public function phone(&$phone, $prefix = false){

            if($prefix){
                return '(' . substr($phone, 0,2) . ')' . substr($phone, 2,4) . '-' . substr($phone, 6,4);
            }

            return substr($phone, 0,4) . '-' . substr($phone, 4,4);

        }

        public function cep(&$value){
            return $this->output(substr($value, 0, 5) . '-' . substr($value, 5, 3) );
        }

        public function cpf_cnpj(&$value){
            $value = trim($value);
            if(strlen($value) == 11){
                return $this->output(substr($value, 0, 3) . '.' . substr($value, 3, 3) . '.' . substr($value, 6, 3) . '-' . substr($value, 9, 2) );
            }else{
                if(strlen($value) == 14){
                    return $this->output(substr($value, 0, 2) . '.' . substr($value, 2, 3) . '.' . substr($value, 5, 3) . '/' . substr($value, 8, 4) . '-' . substr($value, 12,2) );
                }else{
                    return $this->output($value);
                }
            }
        }

        public function cpf(&$value){
            return $this->output(substr($value, 0, 3) . '.' . substr($value, 3, 3) . '.' . substr($value, 6, 3) . '-' . substr($value, 9, 2) );
        }

        public function cnpj(&$value){
            return $this->output(substr($value, 0, 2) . '.' . substr($value, 2, 3) . '.' . substr($value, 5, 3) . '/' . substr($value, 8, 4) . '-' . substr($value, 12,2) );
        }

	public function date($date){
            //echo $date;die;
            $date = explode(' ', $date);
            $date = &$date[0];
            $date = explode('-', $date);

            return $this->output("{$date[2]}/{$date[1]}/{$date[0]}");

	}
	public function money($money, $pre = null){

            if($pre){
                $simbol = 'R$ ';
            }else{
                $simbol = '';
            }
            $money = str_replace(array(','), array('.'), $money);
            //die($money);
            return $this->output( $simbol . number_format((float)$money, 2, ',' , '') );

	}
	public function percente($value){

            return $this->output( number_format($value, 1, '.' , '') . '%' );

	}

	public function status($value){
            switch($value){
                case 'criado':
                    break;
                case 'editando':
                    break;
                case 'finalizado1':
                    break;
                case 'analisando1':
                    break;
                case 'reprovado1':
                    break;
                case 'analisando2':
                    break;
                case 'designado_c':
                    break;
                case 'finalizado_c':
                    break;
                case 'reprovado_c':
                    break;
                case 'analisando3':
                    break;
                case 'reprovado_d':
                    break;
                case 'finalizado_d':
                    break;
                case 'terminado':
                    break;

            }
        }
}

?>