<?php  
App::import('Vendor', 'fpdf/fpdf');

App::uses('AppHelper', 'View/Helper');

class CertificadoPdfHelper extends AppHelper {

    public $Fpdf;
    public function __construct(){
       
        $this->Fpdf = new FPDF();
        $this->Fpdf->AddPage('L','A4');
   
        //$this->Fpdf->image(IMAGES  . 'certificados' . DS . 'certificado.jpg', 0, 0, 297, 210);
    }
    
    public function setTitulo($titulo = null, $imagem = null){
        
        if (!empty($titulo)){
            $titulo = utf8_decode($titulo);
            $this->Fpdf->SetFont('Arial','B',50);
            $this->Fpdf->Ln(30);
            $this->Fpdf->Cell(0, 0,$titulo,0,0,'C');  
            $this->Fpdf->Ln(40);
        }
      
    }
    
    public function setImagemTopo($name_file){
        
        if (!empty($name_file)){
            $this->Fpdf->image(IMAGES  . 'certificados' . DS . $name_file, 30, 30, 20, 30);
        }
      
    }
    
    public function setImagemFundo($name_file){
        
        if (!empty($name_file)){
            $this->Fpdf->image(IMAGES  . 'certificados' . DS . 'certificado.jpg', 0, 0, 297, 210);
        }
      
    }
    
    public function setTextoAntesNome($texto){
        
        $this->Fpdf->SetLeftMargin(50);
        $txt = utf8_decode($texto);
        $this->Fpdf->SetFont('Arial','',15);
        $this->Fpdf->MultiCell(200,7,$txt, 0, 'L');
        
        
        
    }
    public function setNomeParticipante($nome){
        
        $nome = utf8_decode($nome);
        $this->Fpdf->SetFont('Arial','B',15);
        $this->Fpdf->MultiCell(200,7,$nome, 0, 'L');
        
        
    }
    
    public function setTextoDepoisNome($texto){
        
        $txt = utf8_decode($texto);
        $this->Fpdf->SetFont('Arial','',15);
        $this->Fpdf->MultiCell(200,7,$txt, 0, 'L');  
        
    }
    
    public function setNomeCoordenador($nome){
        $this->Fpdf->Ln(45);
        $nome = utf8_decode($nome);
        $this->Fpdf->SetFont('Arial','I',10);
        $this->Fpdf->MultiCell(200,7,$nome, 0, 'C');  
        
    }
    public function setLabelCoordenador($texto){
        $txt = utf8_decode($texto);
        $this->Fpdf->SetFont('Arial','',10);
        $this->Fpdf->MultiCell(200,7,$txt, 0, 'C');  
        
    }
    
    public function setImagemAssinaturaCoord($name_file){
        $this->Fpdf->image(IMAGES  . 'certificados' . DS . $name_file, 125, 130, 50, 25);
        
    }
    
    public function Output(){
        $this->Fpdf->Output('certificado.pdf', 'D');
    }
}