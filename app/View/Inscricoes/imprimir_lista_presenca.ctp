<?php
$header = array('User.name' => 'Participante', 'User.email' => 'e-mail', 'Assinatura');
$this->Fpdf->setTitle("Lista de Presença " . $atividade['Atividade']['nome_atividade']);
$this->Fpdf->BasicTable($header, $inscricoes_atividade);
$this->Fpdf->outPut();