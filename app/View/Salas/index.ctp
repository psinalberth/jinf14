<?php if(empty($salas)) { ?>
	
	<p class="alert alert-info nothing"><i class="icon-info-sign"></i> Não há nenhuma Sala ainda. <?= $this->Html->link( 'Criar Nova', '/salas/add', array( 'class' => 'btn btn-mini' ) ) ?></p>
	
<?php } else { ?>

	<table class="table table-striped">
	<thead>
	<tr>
		<th class="pic"></th>
		<th><?= $this->Paginator->sort( "id", "ID" ) ?></th>
		<th><?= $this->Paginator->sort( "descricao", "Nome" ) ?></th>
		<th><?= $this->Paginator->sort( "localidade", "Localização" ) ?></th>
		<th><?= $this->Paginator->sort( "Departamento.name", "Departamento" ) ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach( $salas as $sala ): ?>

	<tr>
		<td><i class="icon-home"></i></td>
		<!--td><?= $this->Html->link( $sala[ 'sala' ][ 'descricao' ], "/salas/view/{$sala['sala']['id']}", array( 'escape' => false ) ) ?></td-->
		<td><?= $sala[ 'Sala' ][ 'id' ] ?></td>
		<td><?= $sala[ 'Sala' ][ 'descricao' ] ?></td>
		<td><?= $sala[ 'Sala' ][ 'localidade' ] ?></td>
		<td><?= $sala[ 'Departamento' ][ 'name' ] ?></td>
	</tr>
		
	<?php endforeach; ?>
	</tbody>
	</table>

<?php print $this->element( "pagination" ); } ?>