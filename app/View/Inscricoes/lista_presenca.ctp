<?php
        echo $this->Form->create(null, array('type' => 'post', 'action' => 'imprimirListaPresenca'));
        echo $this->Form->input('Agenda.id', array('label' => 'Escolha a atividade:', 'type' => 'select', 'options' => $options, 'empty' => '--'));
        echo $this->Form->end('Imprimir');
?>

