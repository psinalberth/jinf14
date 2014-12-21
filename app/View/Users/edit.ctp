<script type="text/javascript">
    $(document).ready(function () {
        $('#UserNewPassword').val('');
    });
</script>
<div class="form-actions">
    <?php
        print $this->Form->create('User', array('class' => 'form-horizontal'));
        print $this->BForm->input('User.matricula', array('label' => 'Matrícula', 'placeholder' => 'Matrícula', 'type' => 'text'));
        print $this->BForm->input('User.email', array('label' => 'Email', 'placeholder' => 'exemplo@dominio.com', 'type' => 'email'));
        print $this->BForm->input('User.telefone', array('label' => 'Telefone', 'placeholder' => 'Telefone', 'type' => 'text'));
        print $this->BForm->input( 'User.curso_id', array( 'label' => 'Curso:', 'type' => 'select', 'options' => $cursos, 'empty' => '--' ));
        print $this->BForm->input('User.profile_id', array('label' => 'Perfil', 'empty' => '-- Selecione --'));
    ?>

    <fieldset>
        <legend>Mudança de senha <small>Preencha apenas se desejar modificar a senha atual</small></legend>
        <?php
            print $this->BForm->input('User.newPassword', array('label' => 'Nova senha', 'type' => 'password', 'autocomplete' => 'off'));
            print $this->BForm->input('User.passwordConfirm', array('label' => 'Confirme a senha', 'type' => 'password', 'autocomplete' => 'off'));
        ?>
    </fieldset>

    <?= $this->element("submit", array('cancel' => "/users/view/{$this->passedArgs[0]}")) ?>