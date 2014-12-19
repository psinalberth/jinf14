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
    
    public function __construct(){
       
        $this->Fpdf = new FPDF();
        
        $this->fiels;
        
        $this->Fpdf->AddPage('P','A4');
   
        //$this->Fpdf->image(IMAGES  . 'certificados' . DS . 'certificado.jpg', 0, 0, 297, 210);
    }
    
    public function setFields($fields){
        $this->fields = $fields;     
      
    }
    public function setTitle($title){
        $this->Fpdf->SetFont('Arial','B',50);
        $this->Fpdf->Cell(0, 0,$title,0,0,'C');  
        $this->Fpdf->Ln(40);       
    }
    
    function BasicTable($header, $data){
       //Header
       foreach($header as $col)
           $this->Cell(40,7,$col,1);
       $this->Ln();
       // Data
       foreach($data as $row){
           pr($row);die;
           foreach($row as $col)
               $this->Cell(40,6,$col,1);
           $this->Ln();
       }
   }
    
    public function outPut(){
        $this->Fpdf->Output('lista_presenca.pdf', 'D');
    }
}
