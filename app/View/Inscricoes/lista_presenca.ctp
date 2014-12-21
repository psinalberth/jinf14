<?php
        echo $this->Form->create(null, array('type' => 'post', 'action' => 'imprimirListaPresenca'));
        echo $this->Form->input('Agenda.atividade_id', array('label' => 'Escolha a atividade:', 'type' => 'select', 'options' => $atividades, 'empty' => '--', 'required' => true ));
        echo $this->Form->input('Agenda.edicao_id', array('label' => 'Escolha a edição:', 'type' => 'select', 'options' => $edicoes, 'empty' => '--', 'required' => true));
        echo $this->Form->submit('Imprimir', array('class' => 'btn'));
        echo $this->Form->end();
?>

