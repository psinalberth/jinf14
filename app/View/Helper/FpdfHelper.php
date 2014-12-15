<?php  
App::import('Vendor', 'fpdf/fpdf');

App::uses('AppHelper', 'View/Helper');

class FpdfHelper extends AppHelper {

    public $Fpdf;
    public function __construct(){
       
        $this->Fpdf = new FPDF();
        $this->Fpdf->AddPage('L','A4');
        
        $logo = file_get_contents( APP  . 'webroot/img/certificado.jpg');
        $this->Fpdf->image(APP  . 'webroot/img/certificado.jpg', 0, 0, 297, 210);
    }
    
    public function header(){
        $this->Fpdf->SetFont('Arial','B',50);
        $this->Fpdf->Ln(30);
        $this->Fpdf->Cell(0, 0,'Certificado JINF\'14',0,0,'C');        
    }
    
    public function Output(){
        
        $txt = 'Certifica-se que Márcio Venann Participou da quarta edição da Jornada De Informática do Instuto Federal do Maranhão. Com programação de 16 horas';
        $this->Fpdf->Ln(25);
        $this->Fpdf->SetFont('Arial','B',10);
        $this->Fpdf->MultiCell(200,5,$txt, 0, 'C');
        $this->Fpdf->Output('teste2.pdf', 'D');
        
        
    }
}