<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<?php $this->start('sidebar'); ?>
<?= $this->element('sidebar/add'); ?>
<?php $this->end(); ?>

<div>
    <h3>Usuarios</h3>
    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col"><?= $this->Paginator->sort('id', 'ID') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('username', 'Nombre de usuario') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('email', 'Correo electrónico') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('role', 'Rol') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('created', 'Creado') ?></th>
                    <th scope="col"><?= $this->Paginator->sort('modified', 'Modificado') ?></th>
                    <th scope="col" class="actions">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <th scope="row"><?= $this->Number->format($user->id) ?></td>
                        <td><?= h($user->username) ?></td>
                        <td><?= h($user->email) ?></td>
                        <td><?= h($user->role) ?></td>
                        <td><?= h($user->created) ?></td>
                        <td><?= h($user->modified) ?></td>
                        <td class="actions">
                            <?= $this->Html->link('Ver', ['action' => 'view', $user->id]) ?>
                            <?= $this->Html->link('Editar', ['action' => 'edit', $user->id]) ?>
                            <?= $this->Form->postLink('Borrar', ['action' => 'delete', $user->id], ['confirm' => __('¿Está seguro/a que desea borrar al usuario # {0}?', $user->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . 'primera') ?> 
            <?= $this->Paginator->prev('< ' . 'anterior') ?> 
            <?= $this->Paginator->numbers() ?> 
            <?= $this->Paginator->next('siguiente' . ' >') ?> 
            <?= $this->Paginator->last('última' . ' >>') ?> 
        </ul>
        <p><?= $this->Paginator->counter(['format' => 'Página {{page}} de {{pages}}, mostrando {{current}} registro(s) de un total de {{count}}']) ?></p>
    </div>
</div>