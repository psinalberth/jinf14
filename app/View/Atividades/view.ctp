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

<?php echo $this->element( 'deleteModal', array( 'model' => 'Atividade' ) ) ?>