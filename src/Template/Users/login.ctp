<div class="card mx-auto col-12 col-sm-8 col-md-6 col-lg-4">
    <div class="card-body">
        <?= $this->Form->create() ?>
        <fieldset>
            <legend>Iniciar sesión</legend>
            <?= $this->Form->control('username', ['label' => 'Nombre de usuario']) ?>
            <?= $this->Form->control('password', ['label' => 'Contraseña']) ?>
        </fieldset>
        <?= $this->Form->button('Enviar', ['class' => 'btn btn-primary mt-4']); ?>
        <?= $this->Form->end() ?>
    </div>
</div>