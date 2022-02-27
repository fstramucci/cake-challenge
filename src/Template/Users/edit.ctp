<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php $this->start('sidebar'); ?>
<?= $this->element('sidebar/view');?>
<?= $this->element('sidebar/delete');?>
<hr>
<?= $this->element('sidebar/index');?>
<?= $this->element('sidebar/add');?>
<?php $this->end(); ?>

<div>
    <?= $this->Form->create($user) ?>
    <fieldset>
        <legend>Editar usuario</legend>
        <?php
            echo $this->Form->control('username', ['label' => 'Nombre de usuario']);
            echo $this->Form->control('email', ['label' => 'Correo electrónico']);
        ?>
        <div class="input mt-4 role required">
        <?php
            echo $this->Form->label('role', 'Rol');
            echo $this->Form->select('role', ['admin' => 'Administrador', 'guest' => 'Invitado']);
        ?>
        </div>
    </fieldset>
    <?= $this->Form->button('Guardar cambios', ['class' => 'btn btn-primary mt-4']) ?>
    <?= $this->Form->end() ?>
</div>