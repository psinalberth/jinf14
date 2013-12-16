<div class="form-horizontal view">
	<div class="row-fluid title">
		<h2 class="span10"><i class="icon-user"></i> <?php echo $atividade[ 'Atividade' ][ 'nome_atividade' ] ?></h2>
		<div class="span2">
		<?php
			print $this->Html->link( '<i class="icon-trash icon-white"></i> Excluir', "/atividades/delete/{$atividade['Atividade']['id']}", array( 'class' => 'btn btn-mini btn-danger delete', 'escape' => false ) );
			print $this->Html->link( '<i class="icon-edit"></i> Editar', "/atividades/edit/{$atividade['Atividade']['id']}", array( 'class' => 'btn btn-mini', 'escape' => false ) );
		?>
		</div>
	</div>

	<table class="table table-striped">
	<tbody>
		<tr>
			<td class="dlabel">Descricao</td>
			<td class="data"><?php echo $atividade[ 'Atividade' ][ 'descricao' ] ?></td>
		</tr>
		<tr>
			<td class="dlabel">Duração</td>
			<td class="data"><?php echo $atividade[ 'Atividade' ][ 'duracao' ] ?></td>
		</tr>
		<tr>
			<td class="dlabel">Vagas</td>
			<td class="data"><?php echo $atividade[ 'Atividade' ][ 'vagas' ] ?></td>	
		</tr>
	</tbody>
	</table>
</div>
<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    <li class="active"><a href="#tab1" data-toggle="tab">Section 1</a></li>
    <li><a href="#tab2" data-toggle="tab">Section 2</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane active" id="tab1">
      <p>I'm in Section 1.</p>
    </div>
    <div class="tab-pane" id="tab2">
      <p>Howdy, I'm in Section 2.</p>
    </div>
  </div>
</div>
<?php echo $this->element( 'deleteModal', array( 'model' => 'Atividade' ) ) ?>