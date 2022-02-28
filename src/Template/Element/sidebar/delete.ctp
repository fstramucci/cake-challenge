<?php if ($this->Session->read('Auth.User.role') === 'admin' && $this->Session->read('Auth.User.id') !== $user->id): ?>
<li>
    <?= $this->Form->postLink('Borrar usuario', ['action' => 'delete', $user->id], 
        ['class' => 'nav-link text-white', 'confirm' => '¿Está seguro/a que desea borrar al usuario "' . $user->username . '"?']) ?>
</li>
<?php endif; ?>