<?php  
App::import('Vendor', 'fpdf/fpdf');

App::uses('AppHelper', 'View/Helper');

class FpdfHelper extends AppHelper {
    
    public $FPDF;
    
    public function __construct(){
        $this->FPDF = new FPDF();
        //$this->FPDF->AddPage();

    }
    
    public function header(){
   
        $this->FPDF->SetFont('Arial','B',40);
        // Page number
        $this->FPDF->Cell(0,10,'Pag',0,0,'C');     
    }

    function LoadData()
    {
        // Read file lines

        $data = array();
        $lines = array('teste', 'teste2');
        foreach($lines as $line)
            $data[] = $line;
        return $data;
    }  
    
    function BasicTable($header, $data)
    {
        // Header
        foreach($header as $col)
            $this->FPDF->Cell(40,7,$col,1);
        $this->FPDF->Ln();
        // Data

            foreach($data as $col)
                $this->FPDF->Cell(40,6,$col,1);
            $this->FPDF->Ln();
        
    }
    public function Output(){
        
//        $this->FPDF->AliasNbPages();
//        $this->FPDF->AddPage();
//        $this->FPDF->SetFont('Times','',12);
//        for($i=1;$i<=40;$i++)
//            $this->FPDF->Cell(0,10,'Printing line number '.$i,0,1);
//        
//        $this->FPDF->Output('teste.pdf', 'D');
        $header = array('Country', 'Capital');
        $data = $this->LoadData();
        //pr($data);die;
        $this->FPDF->AddPage();
        $this->BasicTable($header,$data);  
        $this->FPDF->Output('teste2.pdf', 'D');
        
        
    }
}