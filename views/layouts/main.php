<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>


<header id="header" class="elegant-header">
    <?php
    NavBar::begin([
        'brandLabel' => '<span class="brand-text">' . 'STS   ' . '</span>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-expand-md fixed-top elegant-navbar',
            'id' => 'main-navbar'
        ],
        'innerContainerOptions' => [
            'class' => 'container-fluid px-4'
        ],
        'togglerContent' => '<span class="navbar-toggler-icon"></span>',
        'togglerOptions' => [
            'class' => 'navbar-toggler custom-toggler'
        ],
    ]);
    
    echo Nav::widget([ 
        'options' => ['class' => 'navbar-nav me-auto main-nav'],
        'encodeLabels' => false,
        'items' => [
            ['label' => '<i class="fas fa-home nav-icon"></i><span class="nav-text">Inicio</span>', 'url' => ['/site/index']],
            ['label' => '<i class="fas fa-chart-line nav-icon"></i><span class="nav-text">Materiales</span>', 'url' => ['/materiales/index']],
            ['label' => '<i class="fas fa-users nav-icon"></i><span class="nav-text">Usuarios</span>', 'url' => ['/usuarios/index']],
        //    ['label' => '<i class="fas fa-envelope nav-icon"></i><span class="nav-text">Solicitud</span>', 'url' => ['/solicitudes/create']],
        ]
    ]);

  
    if (Yii::$app->user->isGuest) {
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav ms-auto user-nav'],
            'encodeLabels' => false,
            'items' => [
                ['label' => '<i class="fas fa-sign-in-alt nav-icon"></i><span class="nav-text">Login</span>', 
                 'url' => ['/site/login'], 
                 'linkOptions' => ['class' => 'nav-link login-link']]
            ]
        ]);
    } else {
        echo '<ul class="navbar-nav ms-auto user-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle user-dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-user-circle nav-icon"></i>
                        <span class="nav-text user-email">' . Yii::$app->user->identity->tbl_usuarios_email . '</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end user-dropdown-menu">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user-cog"></i> Perfil</a></li>
                       
                        <li><hr class="dropdown-divider"></li>
                        <li>' . 
                            Html::beginForm(['/site/logout'], 'post', ['class' => 'logout-form']) .
                            Html::submitButton('<i class="fas fa-sign-out-alt"></i> Cerrar sesión', ['class' => 'dropdown-item logout-button']) .
                            Html::endForm() . 
                        '</li>
                    </ul>
                </li>
            </ul>';
    }
    
    NavBar::end();
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; My Company <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
