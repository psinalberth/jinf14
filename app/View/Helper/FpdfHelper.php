<?php  
App::import('Vendor', 'fpdf/fpdf');

App::uses('AppHelper', 'View/Helper');

class FpdfHelper extends AppHelper {
    
    var $B=0;
    var $I=0;
    var $U=0;
    var $HREF='';
    var $ALIGN='';    
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
    
    public function body(){
    
        $this->Fpdf->Ln(25);
        $this->Fpdf->SetFont('Arial','B',10);
        $this->Fpdf->SetLeftMargin(50);
        $nome = utf8_decode('Certificamos que: Márcio Vennan');
        $this->Fpdf->MultiCell(0,5,$nome);
        //$this->Fpdf->Ln(5);
        
        $this->Fpdf->SetFont('Arial','',10);
        $texto = utf8_decode('Participou da quarta edicao da Jornada De Informática do Instituto Federal do Maranhão. Com programacao de 16 horas.');
        $this->Fpdf->MultiCell(0,5,$texto);
        //$this->WriteHTML('<p>Certificamos que:<i>' . $nome .'</i></p><br> <p align="">'. $texto . '</p><br>');
        $this->Fpdf->Ln(30);

        $this->Fpdf->SetFont('Arial','I',10);
        $this->Fpdf->Cell(0, 0,'Josenildo sdfsadfsadfsadfsadf sfsdfs',0,0,'C');
        //$this->Fpdf->Text(100, 120, 'josenildo');
        $this->Fpdf->Ln(5);

         $this->Fpdf->SetLeftMargin(0);
        $this->Fpdf->SetFont('Arial','',10);
        $this->Fpdf->Cell(0, 0,'Coordenador do Departamento de Informática',0,0,'C');


    }
    
    function WriteHTML($html)
    {
        //HTML parser
        $html=str_replace("\n",' ',$html);
        $a=preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                //Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                elseif($this->ALIGN=='center')
                    $this->Fpdf->Cell(0,5,$e,0,1,'C');
                else
                    $this->Fpdf->MultiCell(200,5,$e);
            }
            else
            {
                //Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                else
                {
                    //Extract properties
                    $a2=explode(' ',$e);
                    $tag=strtoupper(array_shift($a2));
                    $prop=array();
                    foreach($a2 as $v)
                    {
                        if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                            $prop[strtoupper($a3[1])]=$a3[2];
                    }
                    $this->OpenTag($tag,$prop);
                }
            }
        }
    }

    function OpenTag($tag,$prop)
    {
        //Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
        if($tag=='A')
            $this->HREF=$prop['HREF'];
        if($tag=='BR')
            //$this->Fpdf->Ln(5);
        if($tag=='P')
            $this->ALIGN=$prop['ALIGN'];
        if($tag=='HR')
        {
            if( !empty($prop['WIDTH']) )
                $Width = $prop['WIDTH'];
            else
                $Width = $this->w - $this->lMargin-$this->rMargin;
            //$this->Fpdf->Ln(2);
            $x = $this->Fpdf->GetX();
            $y = $this->Fpdf->GetY();
            $this->Fpdf->SetLineWidth(0.4);
            $this->Fpdf->Line($x,$y,$x+$Width,$y);
            $this->Fpdf->SetLineWidth(0.2);
            //$this->Fpdf->Ln(2);
        }
    }

    function CloseTag($tag)
    {
        //Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
        if($tag=='A')
            $this->HREF='';
        if($tag=='P')
            $this->ALIGN='';
    }

    function SetStyle($tag,$enable)
    {
        //Modify style and select corresponding font
        $this->$tag+=($enable ? 1 : -1);
        $style='';
        foreach(array('B','I','U') as $s)
            if($this->$s>0)
                $style.=$s;
        $this->Fpdf->SetFont('',$style);
    }

    function PutLink($URL,$txt)
    {
        //Put a hyperlink
        $this->Fpdf->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Fpdf->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->Fpdf->SetTextColor(0);
    }   
    
    public function Output(){
        
        
        //$this->Fpdf->MultiCell(200,20,$txt, 0, 'C');
        $this->Fpdf->Output('teste2.pdf', 'D');
        
        
    }
}