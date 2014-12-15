<?php if( empty( $pessoas ) ){ ?>

	<p class="alert alert-info nothing"><i class="icon-info-sign"></i> Não há nenhum pessoa cadastrada nessa ativade ainda.  ?></p>

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

	<tr class="yellow">
		<td><i class="icon-user"></i></td>
		<td><?php echo $pessoa[ 'users' ][ 'name' ] ?></td>
		<td><?php if($pessoa[ 'inscricao' ][ 'presenca' ]){ ?>

		<span  class="label label-success">Presente</span>
				<?php } else{ ?>

		<span class="label label-important">Ausente</span>
		<?php } ?>
		</td>

		<td> <div style="float:right"><?php echo $this->Html->link( 'Validar Presença', "/Colaboradores/validapresenca/{$pessoa['inscricao']['id']}", array( 'class' => 'btn btn-mini' ) ) ?></div></td>
		
	</tr>
		
	<?php endforeach; ?>
	</tbody>
	</table>

<?php }?>