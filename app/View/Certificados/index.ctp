<?php
        echo $this->Form->create(null, array('type' => 'post'));
        echo $this->Form->input('User.name', array('label' => 'Digite o nome da pessoa que deseja buscar:'));
        echo $this->Form->input('User.email', array('label' => 'Digite o e-mail da pessoa que deseja buscar:'));
        echo $this->Form->input('Agenda.edicao_id', array('label' => 'Escolha a edição:', 'type' => 'select', 'options' => $options, 'empty' => '--'));
        echo $this->Form->end('Buscar');

?>
<?php if( empty( $inscricoes ) ){ ?>       
	<p class="alert alert-info nothing"><i class="icon-info-sign"></i> Não há nenhuma Atividade cadastrada ainda. <?php echo $this->Html->link( 'Criar Novo', '/atividades/add', array( 'class' => 'btn btn-mini' ) ) ?></p>

<?php } else { ?>
	<table class="table table-striped">
	<thead>
	<tr>
		<th class="pic"></th>
		<th><?php echo $this->Paginator->sort( "User.name", "Nome" ) ?></th>
		<th><?php echo $this->Paginator->sort( "User.email", "E-mail" ) ?></th>
		<th><?php echo $this->Paginator->sort( "User.telefone", "Telefone" ) ?></th>
		<th></th>

	</tr>
	</thead>
	<tbody>
	<?php foreach( $inscricoes as $inscricao ): ?>

	<tr>
		<td><i class="icon-user"></i></td>
		<td><?php echo $this->Html->link( $inscricao[ 'User' ][ 'name' ], "/inscricoes/view/{$inscricao['User']['id']}", array( 'escape' => false ) ) ?></td>
		<td><?php echo $inscricao[ 'User' ][ 'email' ] ?></td>
		<td><?php echo $inscricao[ 'User' ][ 'telefone' ] ?></td>
                <td><?php echo $this->Html->link('imprimir', array('action' => 'imprimir',  $inscricao[ 'Agenda' ]['edicao_id'],  $inscricao[ 'User' ]['id']))?></td>

	</tr>
		
	<?php endforeach; ?>
	</tbody>
	</table>

<?php print $this->element( "pagination" ); } ?>