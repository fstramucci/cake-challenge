<?php if ($this->request->getSession()->read('Auth.User.role') === 'admin' || $this->request->getSession()->read('Auth.User.id') === $user->id): ?>
<li>
    <?= $this->Html->link('Editar usuario', ['action' => 'edit', $user->id], ['class' => 'nav-link text-white']) ?>
</li>
<?php endif; ?>