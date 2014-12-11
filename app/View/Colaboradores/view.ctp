<div class="form-horizontal view">
	<div class="row-fluid title">
		<h2 class="span10"><i class="icon-user"></i> <?php echo $agenda[ 'Atividade' ][ 'nome_atividade' ] ?></h2>
		<div class="span2">
		<?php
			print $this->Html->link( '<i class="icon-trash icon-white"></i> Excluir', "/colaboradores/delete/{$Colaborador['Colaborador']['id']}", array( 'class' => 'btn btn-mini btn-danger delete', 'escape' => false ) );
			print $this->Html->link( '<i class="icon-edit"></i> Editar', "/colaboradores/edit/{$Colaborador['Colaborador']['id']}", array( 'class' => 'btn btn-mini', 'escape' => false ) );
		?>
		</div>
	</div>

	<table class="table table-striped">
	<tbody>
		<tr>
			<td class="dlabel">Usuario</td>
			<td class="data"><?php echo $Colaborador[ 'User' ][ 'name' ] ?></td>
		</tr>
		
		<tr>
			<td class="dlabel">Funcao</td>
			<td class="data"><?php echo $Colaborador[ 'Colaborador' ][ 'funcao' ] ?></td>	
		</tr>
		<tr>
			<td class="dlabel">Tipo da Atividade</td>
			<td class="data"><?php echo $atividade[ 'TipoAtividade' ][ 'nome' ] ?></td>
		</tr>
	</tbody>
	</table>
</div>

<?php echo $this->element( 'deleteModal', array( 'model' => 'Colaborador' ) ) ?>