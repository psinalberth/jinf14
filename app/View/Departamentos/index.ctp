<?php if(empty($departamentos)) { ?>
	
	<p class="alert alert-info nothing"><i class="icon-info-sign"></i> Não há nenhum Usuário ainda. <?= $this->Html->link( 'Criar Novo', '/departamentos/add', array( 'class' => 'btn btn-mini' ) ) ?></p>
	
<?php } else { ?>

	<table class="table table-striped">
	<thead>
	<tr>
		<th class="pic"></th>
		<th><?= $this->Paginator->sort( "id", "ID" ) ?></th>
		<th><?= $this->Paginator->sort( "name", "Nome" ) ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach( $departamentos as $departamento ): ?>

	<tr>
		<td><i class="icon-home"></i></td>
		<!--td><?= $this->Html->link( $departamento[ 'departamento' ][ 'name' ], "/departamentos/view/{$departamento['departamento']['id']}", array( 'escape' => false ) ) ?></td-->
		<td><?= $departamento[ 'Departamento' ][ 'id' ] ?></td>
		<td><?= $departamento[ 'Departamento' ][ 'name' ] ?></td>
	</tr>
		
	<?php endforeach; ?>
	</tbody>
	</table>

<?php print $this->element( "pagination" ); } ?>