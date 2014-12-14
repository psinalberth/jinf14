<div class="search medium">
<?php
        if(empty($param)){
            $param = '';
        }
        echo $this->Form->create( $model, array( 'action' => $this->params['action'] .  '/' . $param, 'type' => 'get', 'class' => 'form' ) );
        
        if(isset($showModal))
            echo $this->Form->hidden('showModal',array('value' => $showModal));
        
        
        
        foreach($campos as $campo){
            
            $value = !empty($_GET[$campo['name']])? $_GET[$campo['name']] : '';
            
            if(isset($campo['condition']) && !$campo['condition']){
                
                echo $this->Form->hidden($model . '.' . $campo['name']);
                
            }else{
                if(!isset($campo['type']) || $campo['type'] == 'text'){
                    echo $this->Form->label($model . '.' . $campo['name'], $campo['label']);
                    echo $this->Form->input($model . '.' . $campo['name'], array('label' => false, 'escape' => false, 'class' => $campo['class'],'value' => $value ));
                }else{
                    switch($campo['type']){
                        case 'select':
                            echo $this->Form->label($model . '.' . $campo['name'], $campo['label']);
                            echo $this->Form->input($model . '.' . $campo['name'], array('label' => false, 'escape' => false, 'class' => $campo['class'],'value' => $value,'options' => $campo['options'],'empty' => '---' ));
                            break;
                        case 'check':
                            echo '<br/>';
                            echo $this->Form->input($model . '.' . $campo['name'], array('label' => false, 'escape' => false, 'class' => $campo['class'],'type' => 'checkbox','checked' => $value));
                            echo $this->Form->label($model . '.' . $campo['name'], $campo['label']);
                            echo '<br/>';
                            break;
                    }
                }
            }
        }
        
        echo $this->Form->submit($label_submit, array('style' => 'float:none ;margin-bottom: 20px;', 'class' => 'submit'));
        echo $this->Form->end();
?>     
</div>
