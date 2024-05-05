<?php

/**
 * the header - included in all pages just after the start of the body tag
 * 
 * @var string $page_name the page type name - used to do conditional stuff in the menu depending on the page type
 */
?>
<header>
    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand user-select-none" href="./">
                <img src="./public/img/logo.png" style="height: 50px;" /> Melody Maker
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topNav" aria-controls="topNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse user-select-none" id="topNav">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-end">
                    <li class="nav-item">
                        <a class="nav-link <?= empty($_REQUEST['uri']) ? 'active' : ''; ?>" href="./">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= !empty($_REQUEST['uri']) && $_REQUEST['uri'] == '/melody-maker' ? 'active' : ''; ?>" href="./melody-maker">Melody Maker</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= !empty($_REQUEST['uri']) && $_REQUEST['uri'] == '/about' ? 'active' : ''; ?>" href="./about">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= !empty($_REQUEST['uri']) && $_REQUEST['uri'] == '/contact' ? 'active' : ''; ?>" href="./contact">Contact</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- navbar -->
</header>
