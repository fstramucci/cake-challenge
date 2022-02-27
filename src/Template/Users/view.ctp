<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php $this->start('sidebar'); ?>
<?= $this->element('sidebar/edit');?>
<?= $this->element('sidebar/delete');?>
<hr>
<?= $this->element('sidebar/index');?>
<?= $this->element('sidebar/add');?>
<?php $this->end(); ?>

<div>
    <h3><?= h($user->username) ?></h3>
    <table class="table">
        <tr>
            <th scope="row">Nombre de usuario</th>
            <td><?= h($user->username) ?></td>
        </tr>
        <tr>
            <th scope="row">Correo electrónico</th>
            <td><?= h($user->email) ?></td>
        </tr>
        <tr>
            <th scope="row">Rol</th>
            <td><?= h($user->role) ?></td>
        </tr>
        <tr>
            <th scope="row">ID</th>
            <td><?= $this->Number->format($user->id) ?></td>
        </tr>
        <tr>
            <th scope="row">Creado</th>
            <td><?= h($user->created) ?></td>
        </tr>
        <tr>
            <th scope="row">Modificado</th>
            <td><?= h($user->modified) ?></td>
        </tr>
    </table>
</div>
