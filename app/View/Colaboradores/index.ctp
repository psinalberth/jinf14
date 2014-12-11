<?php if( empty( $Colaboradores ) ){ ?>

	<p class="alert alert-info nothing"><i class="icon-info-sign"></i> Não há nenhum colaborador cadastrada ainda. <?php echo $this->Html->link( 'Criar Novo', '/Colaboradores/add', array( 'class' => 'btn btn-mini' ) ) ?></p>

<?php } else { ?>

	<table class="table table-striped">
	<thead>
	<tr>
		<th class="pic"></th>
		
		<th><?= $this->Paginator->sort( "Colaborador.programacao_id", "Atividade" ) ?></th>
		<th><?= $this->Paginator->sort( "Colaborador.user_id", "Usuario" ) ?></th>
		<th><?= $this->Paginator->sort( "Colaborador.funcao", "Funcao" ) ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach( $Colaboradores as $Colaborador ): ?>

	<tr>
		<td><i class="icon-user"></i></td>
		<td><?php echo $this->Html->link( $Colaborador[ 'Atividade' ][ 'nome_atividade' ], "/Colaboradores/view/{$Colaborador['Colaborador']['id']}", array( 'escape' => false ) ) ?></td>
		<td><?php echo $Colaborador[ 'Users' ][ 'name' ] ?></td>
		<td><?php echo $Colaborador[ 'Colaborador' ][ 'funcao'] ?></td>

	</tr>
		
	<?php endforeach; ?>
	</tbody>
	</table>

<?php print $this->element( "pagination" );  }?>