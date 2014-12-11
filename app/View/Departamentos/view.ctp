<div class="form-horizontal view">
	<div class="row-fluid title">
		<h2 class="span10"><i class="icon-home"></i> <?php echo $departamento['Departamento']['name'] ?></h2>
		<div class="span2">
		<?php
			print $this->Html->link('<i class="icon-trash icon-white"></i> Excluir', "/departamentos/delete/{$departamento['Departamento']['id']}", array('class' => 'btn btn-mini btn-danger delete', 'escape' => false));
			print $this->Html->link('<i class="icon-edit"></i> Editar', "/departamentos/edit/{$departamento['Departamento']['id']}", array('class' => 'btn btn-mini', 'escape' => false));
		?>
		</div>
	</div>
	<table class="table table-striped">
		<tbody>
			<tr>
				<td class="dlabel">ID</td>
				<td class="data"><?php echo $departamento['Departamento']['id'] ?></td>
			</tr>
			<tr>
				<td class="dlabel">Nome</td>
				<td class="data"><?php echo $departamento['Departamento']['name'] ?></td>
			</tr>
		</tbody>
	</table>
</div>

<?php echo $this->element('deleteModal', array('model' => 'Departamento')) ?>