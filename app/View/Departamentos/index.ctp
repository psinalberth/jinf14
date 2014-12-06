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
	<?php foreach( $departamentos as $user ): ?>

	<tr>
		<td><i class="icon-user"></i></td>
		<td><?= $this->Html->link( $user[ 'User' ][ 'name' ], "/users/view/{$user['User']['id']}", array( 'escape' => false ) ) ?></td>
		<td><?= $user[ 'Departamento' ][ 'id' ] ?></td>
		<td><?= $user[ 'Departamento' ][ 'name' ] ?></td>
	</tr>
		
	<?php endforeach; ?>
	</tbody>
	</table>

<?php print $this->element( "pagination" ); } ?>