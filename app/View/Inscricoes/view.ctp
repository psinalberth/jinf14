<div class="form-horizontal view">
	<div class="row-fluid title">
		<h2 class="span10"><i class="icon-user"></i> <?php echo $inscrito[0][ 'User' ][ 'name' ] ?></h2>
		<div class="span2">
		<?php
			print $this->Html->link( '<i class="icon-trash icon-white"></i> Excluir', "/Inscricoes/delete/{$inscrito[0]['User']['id']}", array( 'class' => 'btn btn-mini btn-danger delete', 'escape' => false ) );
			print $this->Html->link( '<i class="icon-edit"></i> Editar', "/Inscricoes/edit/{$inscrito[0]['User']['id']}", array( 'class' => 'btn btn-mini', 'escape' => false ) );
		?>
		</div>
	</div>

	<table class="table table-striped">
	<tbody>
		<tr>
			<td class="dlabel">Nome:</td>
			<td class="data"><?php echo $inscrito[0][ 'User' ][ 'name' ] ?></td>
		</tr>
		<tr>
			<td class="dlabel">E-mail</td>
			<td class="data"><?php echo $inscrito[0][ 'User' ][ 'email' ] ?></td>
		</tr>
		<tr>
			<td class="dlabel">Telefone</td>
			<td class="data"><?php echo $inscrito[0][ 'User' ][ 'telefone' ] ?></td>	
		</tr>
	</tbody>
	</table>
</div>

<?php echo $this->element( 'deleteModal', array( 'model' => 'Atividade' ) ) ?>

<div class="form-horizontal view">
	<div class="row-fluid title">
		<h2 class="span10">Atividades deste participante:</h2>
	</div>

	<table class="table table-striped">
	<tbody>
            <?php foreach ($inscrito as $atividades):?>
		<tr>
                        <td class="dlabel"></td>
			<td class="data"><?php echo $atividades [ 'Agenda' ][ 'Atividade' ]['nome_atividade'] ?></td>
		</tr>
            <?php endforeach;?>
	</tbody>
	</table>
</div>