<?php if ($this->request->getSession()->read('Auth.User.role') === 'admin'): ?>
<li>
    <?= $this->Html->link('Agregar', ['action' => 'add'], ['class' => 'nav-link text-white']) ?>
</li>
<?php endif; ?>