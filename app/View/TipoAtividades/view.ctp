<div class="form-horizontal view">
	<div class="row-fluid title">
		<h2 class="span10"><i class="icon-user"></i> <?php echo $tipoAtividades[ 'TipoAtividade' ][ 'nome' ] ?></h2>
		<div class="span2">
		<?php
			//print $this->Html->link( '<i class="icon-trash icon-white"></i> Excluir', "/tipoatividades/delete/{$tipoAtividades['TipoAtividade']['id']}", array( 'class' => 'btn btn-mini btn-danger delete', 'escape' => false ) );
			print $this->Html->link( '<i class="icon-edit"></i> Editar', "/tipoatividades/edit/{$tipoAtividades['TipoAtividade']['id']}", array( 'class' => 'btn btn-mini', 'escape' => false ) );
		?>
		</div>
	</div>

	<table class="table table-striped">
	<tbody>
		<tr>
			<td class="dlabel">Nome</td>
			<td class="data"><?php echo $tipoAtividades[ 'TipoAtividade' ][ 'nome' ] ?></td>
		</tr>
	</tbody>
	</table>
</div>

<?php echo $this->element( 'deleteModal', array( 'model' => 'TipoAtividade' ) ) ?>