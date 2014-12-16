<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {
	
	/*----------------------------------------
	 * Atributtes
	 ----------------------------------------*/ 
	
	public $actsAs 	= array( 'Containable' );

	public $label	= '$Modelo$';

	public $gender	= 'o';
        
        public $fields_upload = array();
        
        public $path_upload;


	/*----------------------------------------
	 * Validation Methods
	 ----------------------------------------*/ 
        public function beforeSave()  
        {  
            //Fazendo uploads de arquivos
            foreach ($this->fields_upload as $field){
                if(!empty( $this->data[$this->name][$field]['name'])) { 
                    $this->data[$this->name][$field] = $this->upload($this->data[$this->name][$field], $this->path_upload);  
                } else{  
                    unset($this->data[$this->name][$field]);  
                } 
            }
        }  	
        
        
	public function cpf( $check ){
		
		$cpf = html_entity_decode( array_pop( $check ) );
		if( !ereg( "([0-9]{3})[.]([0-9]{3})[.]([0-9]{3})[-]([0-9]{2})", $cpf ) ) return false;
		if( $cpf == "000.000.000-00" ) return false;
		
		$cpf = str_replace( array( ".", "-" ), "", $cpf );
		
		//	pega o digito verificador
		$dv_informado = (int)substr( $cpf, 9, 2 );
		
		//	calcula o valor do 10 digito de verificacao
		$soma = 0;
		for( $i = 0, $posicao = 10 ; $i < 9 ; $i++, $posicao-- )
			$soma += ( (int)$cpf{$i} ) * $posicao;
		
		$d10 = $soma % 11;
		if( $d10 < 2 ) $d10 = 0;
		else $d10 = 11 - $d10;
		
		//	calcula o valor do 11 digito de verificacao
		;
		$soma = 0;
		for( $i = 0, $posicao = 11 ; $i < 10 ; $i++, $posicao-- )
			$soma += ( (int)$cpf{$i} ) * $posicao;
		
		$d11 = $soma % 11;
		if( $d11 < 2 ) $d11 = 0;
		else $d11 = 11 - $d11;
		
		//	verifica se o dv calculado eh igual ao informado
		$dv = $d10 * 10 + $d11;
		
		return ( $dv == $dv_informado );
	}
	
	public function cnpj( $check ){
		
		$cnpj = html_entity_decode( array_pop( $check ) );
		if( !ereg( "([0-9]{2})[.]([0-9]{3})[.]([0-9]{3})[/]([0-9]{4})[-]([0-9]{2})", $cnpj ) ) return false;
		if( $cnpj == "00.000.000/0000-00" ) return false;
		
		$cnpj = str_replace( array( '.', '/', '-' ), "", $cnpj );
		
   		$j = 5;
		$k = 6;
		$soma1 = "";
		$soma2 = "";
		
		for($i = 0; $i < 13; $i++){
			
			$j = $j == 1 ? 9 : $j;
			$k = $k == 1 ? 9 : $k;
			$soma2 += ($cnpj{$i} * $k);
		
			if ($i < 12){
				$soma1 += ($cnpj{$i} * $j);
			}
			
			$k--;
			$j--;
		}
		
		$digito1 = $soma1 % 11 < 2 ? 0 : 11 - $soma1 % 11;
		$digito2 = $soma2 % 11 < 2 ? 0 : 11 - $soma2 % 11;
		
		return (($cnpj{12} == $digito1) and ($cnpj{13} == $digito2));
	}
	
	public function cep( $check ){
       
        $string = html_entity_decode( array_pop( $check ) );
        return ereg( "([0-9]{5})[-]([0-9]{3})", $string );
    }
   
    public function phone( $check ){
       
        $string = html_entity_decode( array_pop( $check ) );
        return ereg( "[(]([0-9]{2})[)]([0-9]{4})[-]([0-9]{4})", $string );
    }
    
	public function file( $check ){
       
		$file = array_pop( $check );
        if( $file[ 'error' ] != 0 ) return false;
        else return true;
    }
    
	public function float( $check ){
       
        $string = html_entity_decode( array_pop( $check ) );
        return preg_match( "/(^\d*\,?\d*[1-9]+\d*$)|(^[1-9]+\d*\,\d*$)/", $string );
    }
    
	public function digits( $check ){
		
		return ctype_digit( array_pop( $check ) );
	}

	public function alphaNumeric( $check ){
		
		return ctype_alnum( array_pop( $check ) );
	}

	/*------------------------------------------
     * Miscellaneous Functions
     *-----------------------------------------*/

	protected function formatDate( $field ){
		
		if( isset( $this->data[ $this->name ][ $field ] ) )
			$this->data[ $this->name ][ $field ] = substr( $this->data[ $this->name ][ $field ], 6 ) ."-". substr( $this->data[ $this->name ][ $field ], 3, 2 ) ."-". substr( $this->data[ $this->name ][ $field ], 0, 2 );
	}
	
	protected function fixNewLine( $field, $replace = "" ){
		
		if( isset( $this->data[ $this->name ][ $field ] ) )
			$this->data[ $this->name ][ $field ] = str_replace( "\\n", $replace, $this->data[ $this->name ][ $field ] );
	}
        
        
        /** 
         * Organiza o upload. 
         * @access public 
         * @param Array $imagem 
         * @param String $data 
        */   
        public function upload($imagem = array(), $dir = 'img')  
        {  
            $dir = WWW_ROOT.$dir.DS;  

            if(($imagem['error']!=0) and ($imagem['size']==0)) {  
                throw new  Exception('Alguma coisa deu errado, o upload retornou erro '.$imagem['error'].' e tamanho '.$imagem['size']);  
            }  

            $this->checa_dir($dir);  

            $imagem = $this->checa_nome($imagem, $dir);  

            $this->move_arquivos($imagem, $dir);  

            return $imagem['name'];  
        }  
        /** 
         * Verifica se o diretório existe, se não ele cria. 
         * @access public 
         * @param Array $imagem 
         * @param String $data 
        */   
        public function checa_dir($dir)  
        {  
            App::uses('Folder', 'Utility');  
            $folder = new Folder();  
            if (!is_dir($dir)){  
                $folder->create($dir);  
            }  
        }  

        /** 
         * Verifica se o nome do arquivo já existe, se existir adiciona um numero ao nome e verifica novamente 
         * @access public 
         * @param Array $imagem 
         * @param String $data 
         * @return nome da imagem 
        */   
        public function checa_nome($imagem, $dir)  
        {  
            $imagem_info = pathinfo($dir.$imagem['name']);  
            $imagem_nome = $this->trata_nome($imagem_info['filename']).'.'.$imagem_info['extension'];  
            debug($imagem_nome);  
            $conta = 2;  
            while (file_exists($dir.$imagem_nome)) {  
                $imagem_nome  = $this->trata_nome($imagem_info['filename']).'-'.$conta;  
                $imagem_nome .= '.'.$imagem_info['extension'];  
                $conta++;  
                debug($imagem_nome);  
            }  
            $imagem['name'] = $imagem_nome;  
            return $imagem;  
        }  

        /** 
         * Trata o nome removendo espaços, acentos e caracteres em maiúsculo. 
         * @access public 
         * @param Array $imagem 
         * @param String $data 
        */   
        public function trata_nome($imagem_nome)  
        {  
            $imagem_nome = strtolower(Inflector::slug($imagem_nome,'-'));  
            return $imagem_nome;  
        }  

        /** 
         * Move o arquivo para a pasta de destino. 
         * @access public 
         * @param Array $imagem 
         * @param String $data 
        */   
        public function move_arquivos($imagem, $dir)  
        {  
            App::uses('File', 'Utility');  
            $arquivo = new File($imagem['tmp_name']);  
            $arquivo->copy($dir.$imagem['name']);  
            $arquivo->close();  
        }  	
}