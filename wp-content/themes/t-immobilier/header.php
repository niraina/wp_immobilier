<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php wp_head(); ?>
</head>
<?php
$_template_path = get_template_directory_uri();
$_template_path = parse_url($_template_path, PHP_URL_PATH);
?>
<body>
    <header class="header-immobilier">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="<?= $_template_path; ?> ./assets/img/logo.png" alt="">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <?php wp_nav_menu([
                            'theme_location' => 'header',
                            'container' => false,
                            'menu_class' => 'navbar-nav me-auto ms-auto',
                        ])  
                    ?>
                    <div class="partenaire d-flex">
                        <p>Vous êtes propriétaire?</p>
                        <div class="switch_langue ">
                            <a href="#">
                                <img src="<?= $_template_path; ?> ./assets/img/fr.svg" alt="">
                            </a>
                            <a href="#">
                                <img src="<?= $_template_path; ?> ./assets/img/en.svg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </header>