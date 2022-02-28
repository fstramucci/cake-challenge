<?php

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        Cake Challenge -
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <!-- Bootstrap 5.1.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/57a891b8cd.js" crossorigin="anonymous"></script>

    <?= $this->Html->css('style.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body class="d-flex flex-column vh-100">
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary" role="navigation">
        <div class="container">
            <a class="navbar-brand" href="/">Cake Challenge</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link <?= $active_menu_item === 'home' ? 'active' : '' ?>" href="/">Introducción</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= $active_menu_item === 'users' ? 'active' : '' ?>" href="/users">Usuarios</a>
                    </li>

                    <?php if ($this->Session->read('Auth.User')): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="/users/logout">Cerrar sesión (<?= $this->Session->read('Auth.User.username') ?>)</a>
                    </li>
                    <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $active_menu_item === 'login' ? 'active' : '' ?>" href="/users/login">Iniciar sesión</a>
                    </li>
                    <?php endif; ?>

                </ul>

                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
                
            </div>
        </div>
    </nav>

    <main class="d-flex flex-grow-1 flex-column flex-md-row">
        <?php if ($this->fetch('sidebar')) : ?>
            <div class="d-flex flex-column flex-grow-0 p-3 text-white bg-dark col-12 col-md-3 col-lg-2">
                <ul class="nav nav-pills flex-column mb-auto">
                    <?= $this->fetch('sidebar') ?>
                </ul>
            </div>
        <?php endif; ?>

        <div class="py-2" style="overflow-x: auto; flex-grow: 999;">
            <div class="container">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </main>

    <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-0 border-top">
        <div class="col-md-4 d-flex justify-content-center">
            <span class="text-muted">Franco A. Stramucci -
                <a href="https://github.com/fstramucci/cake-challenge" target="_blank" title="Repositorio en GitHub">
                    código fuente
                </a>
            </span>
        </div>

        <ul class="nav col-md-4 d-flex justify-content-center list-unstyled">
            <li class="ms-3">
                <a class="text-muted" href="https://www.linkedin.com/in/franco-stramucci/" target="_blank">
                    <i class="fab fa-linkedin"></i>
                </a>
            </li>
            <li class="ms-3">
                <a class="text-muted" href="https://github.com/fstramucci" target="_blank">
                    <i class="fab fa-github"></i>
                </a>
            </li>
            <li class="ms-3">
                <a class="text-muted" href="https://gitlab.com/fstramucci" target="_blank">
                    <i class="fab fa-gitlab"></i>
                </a>
            </li>
        </ul>
    </footer>
</body>

</html>