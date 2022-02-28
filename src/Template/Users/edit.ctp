<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php $this->start('sidebar'); ?>
<?= $this->element('sidebar/view'); ?>
<?= $this->element('sidebar/delete'); ?>
<hr>
<?= $this->element('sidebar/index'); ?>
<?= $this->element('sidebar/add'); ?>
<?php $this->end(); ?>

<div class="card mx-auto col-12 col-md-8 col-lg-6">
    <div class="card-body">
        <?= $this->Form->create($user) ?>
        <fieldset>
            <legend>Editar usuario</legend>
            <?php
            echo $this->Form->control('username', ['label' => 'Nombre de usuario']);
            echo $this->Form->control('email', ['label' => 'Correo electrónico']);

            // nadie puede editar su propio rol
            $disabledRole = $this->Session->read('Auth.User.id') === $user->id;
            ?>
            <div class="input mt-4 role required">
                <?php
                echo $this->Form->label('role', 'Rol');
                echo $this->Form->select('role', ['admin' => 'Administrador', 'guest' => 'Invitado'], ['disabled' => $disabledRole]);
                ?>
            </div>
            <?= $this->Form->control('password', [
                'label' => 'Cambiar contraseña', 
                'required' => false,
                'value' => '',
                'autocomplete' => 'new-password'
            ]); ?>
            <div class="form-text">Deje en blanco si no desea cambiar la contraseña.</div>
            
        </fieldset>
        <?= $this->Form->button('Guardar cambios', ['class' => 'btn btn-primary mt-4']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>