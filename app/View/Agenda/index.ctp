<?php
	print $this->Form->create( 'Agenda', array('type' => 'post') );
	print $this->Form->input( 'Agenda.ano', array('label' => 'Digite a edição que deseja buscar:') );
	
 	//print $this->Form->button( '<i class="icon-search icon-white"></i>Buscar', array( 'class' => 'btn btn-primary pull-left submit', 'div' => false, 'escape' => false ) );
        print $this->Form->end('Buscar') 
?>

<?php if (!empty($programacao)):?>
<?php 
    $i = 0;
    $data_ini = $programacao[0]['Edicao']['data_ini'];
    $total_dias = 0;
    while ($data_ini <= $programacao[0]['Edicao']['data_fim']) {
    $total_dias++;
    $data_ini++;
    }

?>
<div class="form-actions">
<?php $abas = array();?>
<div class="tabbable"> <!-- Only required for left/right tabs -->
  <ul class="nav nav-tabs">
    	<?php $data = $programacao[0]['Edicao']['data_ini'];?>
		<?php while ($data <= $programacao[0]['Edicao']['data_fim']):?>
	    <li  class="<?php if ($i == 0) echo 'active'?>"><a href="#tab<?php echo $i ?>" data-toggle="tab"><?php  echo 'Dia '. $this->Time->format('d/m/y',$data);?></a></li>
	    <?php $abas[] =  $data;?>
		<?php $data++; $i++; endwhile; ?>
  </ul>
  <div class="tab-content">
  	<?php $data = $programacao[0]['Edicao']['data_ini'];$i =0;?>
  	<?php while ($data <= $programacao[0]['Edicao']['data_fim']):?>
    <div class="tab-pane <?php if ($i == 0) echo 'active'?>" id="tab<?php echo $i?>">
		<table class="table table-hover">
		  <thead>
		    <tr>
		      <th>Hora</th>
		      <th>Atividade</th>
		      <th>Tipo Atividade</th>
                      <th>Sala</th>
		      <th>Vagas Restante</th>			  
		    </tr>
		  </thead>
		  <tbody>
			<?php foreach ($programacao as $key => $prog):?>
		    <tr>
		    <?php if (!empty($prog['Agenda']['data'])):?>		
				  <?php if ($abas[$i]  == $prog['Agenda']['data']){ ?>
				      <td><?php echo  $prog['Agenda']['horario_ini'] . ' - ' . $prog['Agenda']['horario_fim']?></td>
				      <td><?php echo $prog['Atividade']['nome_atividade'] ?></td>
                                      <td><?php echo $prog['TipoAtividade']['nome'] ?></td>
                                      <td><?php echo $prog['Sala']['descricao'] ?></td>
		                      <td><?php echo $prog['Agenda']['vagas_restantes'] ?></td>
	              <?php } ?> 			
			    </tr>
		    <?php endif?>
			<?php endforeach;?>
		
		  </tbody>
		</table> 
		<a href="<?php echo $this->Html->url(array('controller' => 'agenda', 'action' => 'add' ,$abas[$i]))?>" class="btn btn-primary">Adicionar</a> 
    </div>
	<?php $data++; $i++;endwhile; ?>
	
  </div>
</div>
<?php endif?>
</div>

