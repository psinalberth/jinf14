<?php

if ($certificado){
    $this->CertificadoPdf->setImagemFundo($certificado['ConfigCertificado']['imagem_fundo']);
    $this->CertificadoPdf->setImagemTopo($certificado['ConfigCertificado']['imagem_topo']);
    $this->CertificadoPdf->setTitulo($certificado['ConfigCertificado']['titulo']);   
    $this->CertificadoPdf->setTextoAntesNome($certificado['ConfigCertificado']['texto_antes']);
    $this->CertificadoPdf->setNomeParticipante($certificado['ConfigCertificado']['participante']);
    $this->CertificadoPdf->setTextoDepoisNome($certificado['ConfigCertificado']['texto_depois']);
    $this->CertificadoPdf->setNomeCoordenador($certificado['ConfigCertificado']['coordenador']);
    $this->CertificadoPdf->setLabelCoordenador($certificado['ConfigCertificado']['label_coordenador']);
    $this->CertificadoPdf->setImagemAssinaturaCoord($certificado['ConfigCertificado']['imagem_assinatura_coord']);
    $this->CertificadoPdf->Output();

}