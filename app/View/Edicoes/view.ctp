<div class="form-horizontal view">
	<div class="row-fluid title">
		<h2 class="span10"><i class="icon-user"></i> <?php echo $edicoes[ 'Edicao' ][ 'nome' ] ?></h2>
		<div class="span2">
		<?php
			print $this->Html->link( '<i class="icon-trash icon-white"></i> Excluir', "/edicoes/delete/{$edicoes['Edicao']['id']}", array( 'class' => 'btn btn-mini btn-danger delete', 'escape' => false ) );
			print $this->Html->link( '<i class="icon-edit"></i> Editar', "/edicoes/edit/{$edicoes['Edicao']['id']}", array( 'class' => 'btn btn-mini', 'escape' => false ) );
		?>
		</div>
	</div>

	<table class="table table-striped">
	<tbody>
		<tr>
			<td class="dlabel">Data Início</td>
			<td class="data"><?php echo $edicoes[ 'Edicao' ][ 'data_ini' ] ?></td>
		</tr>
		<tr>
			<td class="dlabel">Data Fim</td>
			<td class="data"><?php echo $edicoes[ 'Edicao' ][ 'data_fim' ] ?></td>
		</tr>
		<tr>
			<td class="dlabel">Ano</td>
			<td class="data"><?php echo $edicoes[ 'Edicao' ][ 'ano' ] ?></td>	
		</tr>
		<tr>
			<td class="dlabel">Local</td>
			<td class="data"><?php echo $edicoes[ 'Edicao' ][ 'local' ] ?></td>	
		</tr>
	</tbody>
	</table>
</div>

<?= $this->element( 'deleteModal', array( 'model' => 'Usuário' ) ) ?>