<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FpdfHelper
 *
 * @author marcio
 */
App::import('Vendor', 'fpdf/fpdf');

App::uses('AppHelper', 'View/Helper');

class FpdfHelper extends AppHelper{
    
    public $Fpdf;
    
    public $fiels;
    
    public $data;
    
    
    public function __construct(){
       
        $this->Fpdf = new FPDF();
        
        $this->Fpdf->AddPage('P','A4');
   
        //$this->Fpdf->image(IMAGES  . 'certificados' . DS . 'certificado.jpg', 0, 0, 297, 210);
    }
    
    public function setFields($fields){
        $this->fields = $fields;     
      
    }
    public function setData($data){
        $this->data = $data;     
      
    }
    public function setTitle($title){
        $title = utf8_decode($title);
        $this->Fpdf->SetFont('Arial','B',20);
        $this->Fpdf->Cell(0, 0,$title,0,0,'C');  
        $this->Fpdf->Ln(40);       
    }
    
    function BasicTable($header, $data){
       //Header
         $this->Fpdf->SetFont('Arial','',10);
       foreach($header as $col)
           $this->Fpdf->Cell(60,7,$col,1);
       $this->Fpdf->Ln();
       // Data
       $this->formatData($header, $data);
       
       //pr($this->data);
       foreach($this->data as $row){
           //pr($row);die;
           foreach($row as $col)
               //pr($col);
               $this->Fpdf->Cell(60,6,$col,1);
           $this->Fpdf->Ln();
       }
   }
   
   function formatData($fields, $data){
      
       foreach ($data as $d){    
           
          foreach ($fields as $key => $value) { 
              if (is_string($key)){
                  $model_field = explode('.', $key);

                  if (is_array($model_field)){
                      $model = $model_field[0];
                      $field = $model_field[1];
                      $row[] = $d[$model][$field];                 
                  }
              }else{
                  $row[] = '';
              }
          }
          
          //pr($row); 
          $this->data[] = $row;
          $row = null;
       }
       
      //pr($this->data); die;
   }
    
    public function outPut(){
        $this->Fpdf->Output('lista_presenca.pdf', 'D');
    }
}
