<?php if( empty( $tipoAtividades ) ){ ?>

	<p class="alert alert-info nothing"><i class="icon-info-sign"></i> Não há nenhum Tipo de Atividade cadastrada ainda. <?php echo $this->Html->link( 'Criar Novo', '/TipoAtividades/add', array( 'class' => 'btn btn-mini' ) ) ?></p>

<?php } else { ?>


	<table class="table table-striped">
	<thead>
	<tr>
		<th class="pic"></th>
		<th><?php echo $this->Paginator->sort( "TipoAtividade.nome", "Tipo de Atividade" ) ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach( $tipoAtividades as $tipoAtividade ): ?>

	<tr>
		<td><i class="icon-user"></i></td>
		<td><?php echo $this->Html->link( $tipoAtividade[ 'TipoAtividade' ][ 'nome' ], "/tipoatividades/view/{$tipoAtividade['TipoAtividade']['id']}", array( 'escape' => false ) ) ?></td>
		<td><?php echo $tipoAtividade[ 'TipoAtividade' ][ 'nome' ] ?></td>
		<td><?php echo ''?></td>

	</tr>
		
	<?php endforeach; ?>
	</tbody>
	</table>

<?php print $this->element( "pagination" ); } ?>