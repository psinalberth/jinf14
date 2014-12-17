<?php if( empty( $atividades ) ){ ?>

	<p class="alert alert-info nothing"><i class="icon-info-sign"></i> Não há nenhuma Atividade cadastrada ainda. <?php echo $this->Html->link( 'Criar Novo', '/atividades/add', array( 'class' => 'btn btn-mini' ) ) ?></p>

<?php } else { ?>


	<table class="table table-striped">
	<thead>
	<tr>
		<th class="pic"></th>
		<th><?php echo $this->Paginator->sort( "Atividade.nome_atividade", "Nome" ) ?></th>
		<th><?php echo $this->Paginator->sort( "TipoAtividade.nome", "Tipo Atividade" ) ?></th>
		<th><?php echo $this->Paginator->sort( "Atividade.duracao", "Duracao" ) ?></th>
		<th><?php echo $this->Paginator->sort( "Atividade.vagas", "Vagas" ) ?></th>
		<th> Validar Presença</th>


	</tr>
	</thead>
	<tbody>
	<?php foreach( $atividades as $atividade ): ?>

	<tr>
		<td><i class="icon-user"></i></td>
		<td><?php echo $this->Html->link( $atividade[ 'Atividade' ][ 'nome_atividade' ], "/atividades/view/{$atividade['Atividade']['id']}", array( 'escape' => false ) ) ?></td>
		<td><?php echo $atividade[ 'TipoAtividade' ][ 'nome' ] ?></td>
		<td><?php echo $atividade[ 'Atividade' ][ 'duracao' ] ?></td>
		<td><?php echo $atividade[ 'Atividade' ][ 'vagas' ] ?></td>
		
		<td><?php echo $this->Html->link( 'Validar Presença', "/Atividades/listapresenca/{$atividade['Atividade']['id']}", array( 'class' => 'btn btn-mini' ) ) ?></div></td>

	</tr>
		
	<?php endforeach; ?>
	</tbody>
	</table>

<?php print $this->element( "pagination" ); } ?>