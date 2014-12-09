<?php if( empty( $edicoes ) ){ ?>

	<p class="alert alert-info nothing"><i class="icon-info-sign"></i> Não há nenhuma Edição cadastrada ainda. <?php echo $this->Html->link( 'Criar Novo', '/edicoes/add', array( 'class' => 'btn btn-mini' ) ) ?></p>

<?php } else { ?>

	<table class="table table-striped">
	<thead>
	<tr>
		<th class="pic"></th>
		<th><?= $this->Paginator->sort( "Edicao.nome", "Nome" ) ?></th>
		<th><?= $this->Paginator->sort( "Edicao.data_ini", "Data Início" ) ?></th>
		<th><?= $this->Paginator->sort( "Edicao.data_fim", "Data Fim" ) ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach( $edicoes as $edicao ): ?>

	<tr>
		<td><i class="icon-user"></i></td>
		<td><?php echo $this->Html->link( $edicao[ 'Edicao' ][ 'nome' ], "/edicoes/view/{$edicao['Edicao']['id']}", array( 'escape' => false ) ) ?></td>
		<td><?php echo $edicao[ 'Edicao' ][ 'data_ini' ] ?></td>
		<td><?php echo $edicao[ 'Edicao' ][ 'data_fim' ] ?></td>

	</tr>
		
	<?php endforeach; ?>
	</tbody>
	</table>

<?php print $this->element( "pagination" ); } ?>