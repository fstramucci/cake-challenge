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
    <?php if (!empty($query)): ?>
    <div class="alert alert-secondary">
        <p>Búsqueda activa: <em>"<?= h($query) ?>"</em></p>
        <a href="/users" class="btn btn-light">Restablecer</a>
    </div>
    <?php endif; ?>
    
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
                            <?php
                            if ($this->request->getSession()->read('Auth.User.id') === $user->id) {
                                // es a sí mismo, solo permitir edición (admin y guest)
                                echo $this->Html->link('Editar', ['action' => 'edit', $user->id]).' ';

                            } elseif ($this->request->getSession()->read('Auth.User.role') === 'admin') { 
                                // es a otros, solo los admin pueden editar, borrar y (des)activar
                                echo $this->Html->link('Editar', ['action' => 'edit', $user->id]).' ';
                                echo $this->Form->postLink('Borrar', ['action' => 'delete', $user->id], ['confirm' =>'¿Está seguro/a que desea borrar al usuario "'.$user->id.'"?']).' ';

                                if ($user->inactive) {
                                    echo $this->Form->postLink('Reactivar', ['action' => 'edit', $user->id], ['data' => ['inactive' => 0]]);
                                } else {
                                    echo $this->Form->postLink('Desactivar', ['action' => 'edit', $user->id], ['data' => ['inactive' => 1]]);
                                }
                            }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< primera') ?> 
            <?= $this->Paginator->prev('< anterior') ?> 
            <?= $this->Paginator->numbers() ?> 
            <?= $this->Paginator->next('siguiente >') ?> 
            <?= $this->Paginator->last('última >>') ?> 
        </ul>
        <p><?= $this->Paginator->counter(['format' => 'Página {{page}} de {{pages}}, mostrando {{current}} registro(s) de un total de {{count}}']) ?></p>
    </div>
</div>