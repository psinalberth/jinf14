<?php if( empty( $pessoas ) ){ ?>

	<p class="alert alert-info nothing"><i class="icon-info-sign"></i> Não há nenhum colaborador cadastrada ainda. <?php echo $this->Html->link( 'Criar Novo', '/Colaboradores/add', array( 'class' => 'btn btn-mini' ) ) ?></p>

<?php } else { ?>

	<table class="table table-striped">
	<thead>
	<tr>
		<th class="pic"></th>
		
		<th>Usuarios</th>
	</tr>
	</thead>
	<tbody>
	<?php foreach( $pessoas as $pessoa ): ?>

	<tr>
		<td><i class="icon-user"></i></td>
		<td><?php echo $pessoa[ 'users' ][ 'name' ] ?></td>
		
	</tr>
		
	<?php endforeach; ?>
	</tbody>
	</table>

<?php }?>