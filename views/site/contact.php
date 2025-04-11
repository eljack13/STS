<?php
/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\ContactForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;

$this->title = 'Contacto';

$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js');
$this->registerJsFile('https://unpkg.com/aos@2.3.1/dist/aos.js');

$contactCss = <<<CSS
:root {
    --primary-color: #1a365d;
    --secondary-color: #2c5282;
    --accent-color: #3182ce;
    --light-color: #f8f9fa;
    --dark-color: #1a202c;
    --border-color: #e2e8f0;
    --success-color: #38a169;
    --error-color: #e53e3e;
    --card-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    --input-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    --button-shadow: 0 4px 10px rgba(26, 54, 93, 0.25);
}

body {
    background-color: #f8fafc;
    background-image: 
        radial-gradient(circle at 10% 20%, rgba(26, 54, 93, 0.03) 0%, transparent 20%),
        radial-gradient(circle at 90% 80%, rgba(49, 130, 206, 0.03) 0%, transparent 20%),
        linear-gradient(135deg, rgba(247, 250, 252, 0.8) 0%, rgba(237, 242, 247, 0.8) 100%);
    background-attachment: fixed;
    min-height: 100vh;
}

.contact-container {
    width: 100%;
    max-width: 1000px;
    margin: 0 auto;
    padding: 2rem 1rem;
}

.contact-card {
    background: white;
    border-radius: 12px;
    box-shadow: var(--card-shadow);
    overflow: hidden;
    position: relative;
    margin: 0 auto;
    border: 1px solid rgba(226, 232, 240, 0.8);
    max-width: 1000px;
    width: 100%;
}

.contact-row {
    display: flex;
    flex-wrap: wrap;
}

.contact-image-col {
    flex: 1;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 3rem 2.5rem;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 400px;
    position: relative;
}

.company-logo {
    position: absolute;
    top: 1.5rem;
    left: 1.5rem;
    font-size: 1.5rem;
    font-weight: 800;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    z-index: 2;
}

.company-logo i {
    font-size: 1.8rem;
    color: white;
}

.contact-image-content {
    max-width: 400px;
    z-index: 1;
}

.contact-image-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.contact-image-text {
    margin-bottom: 2rem;
    line-height: 1.6;
}

.contact-form-col {
    flex: 1;
    padding: 3rem 2.5rem;
    position: relative;
}

.contact-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
    position: relative;
    display: inline-block;
}

.contact-title:after {
    content: '';
    position: absolute;
    left: 0;
    bottom: -10px;
    width: 50px;
    height: 3px;
    background: var(--accent-color);
    border-radius: 3px;
}

.contact-subtitle {
    color: #718096;
    margin-bottom: 2rem;
    font-size: 1.1rem;
}

.form-group {
    margin-bottom: 1.5rem;
    position: relative;
}

.form-control {
    height: 50px;
    border-radius: 8px;
    border: 1.5px solid #e2e8f0;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    transition: all 0.3s ease;
    box-shadow: var(--input-shadow);
    width: 100%;
}

.form-control:focus {
    border-color: var(--accent-color);
    box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.2);
    outline: none;
}

textarea.form-control {
    height: auto;
    min-height: 150px;
    resize: vertical;
}

.captcha-container {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.captcha-image {
    border-radius: 8px;
    box-shadow: var(--input-shadow);
}

.captcha-reload {
    color: var(--accent-color);
    cursor: pointer;
    font-size: 1.2rem;
    transition: all 0.3s ease;
}

.captcha-reload:hover {
    transform: rotate(90deg);
}

.contact-btn {
    display: block;
    width: 100%;
    height: 50px;
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: var(--button-shadow);
}

.contact-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(26, 54, 93, 0.3);
}

.site-footer {
    text-align: center;
    padding: 1rem 0;
    color: #718096;
    font-size: 0.9rem;
    margin-top: 2rem;
}

@media (max-width: 991.98px) {
    .contact-row {
        flex-direction: column;
    }
    
    .contact-image-col {
        min-height: 300px;
        padding: 2rem 1rem;
    }
    
    .contact-form-col {
        padding: 2rem 1.5rem;
    }
}

@media (max-width: 767.98px) {
    .contact-image-col {
        min-height: 250px;
    }
    
    .contact-image-title {
        font-size: 1.8rem;
    }
    
    .contact-title {
        font-size: 1.8rem;
    }
}
CSS;

$this->registerCss($contactCss);

$contactJs = <<<JS
document.addEventListener('DOMContentLoaded', function() {
    AOS.init({
        duration: 800,
        easing: 'ease-out',
        once: true
    });
    
    const contactForm = document.getElementById('contact-form');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            const submitBtn = this.querySelector('[type="submit"]');
            if (submitBtn) {
                submitBtn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Enviando...';
                submitBtn.disabled = true;
            }
        });
    }
});
JS;

$this->registerJs($contactJs);
?>

<div class="contact-container">
    <div class="contact-card" data-aos="fade-up">
        <div class="contact-row">
            <div class="contact-image-col" data-aos="fade-right">
                <div class="company-logo">
                    <i class="fas fa-truck-moving"></i>
                    <span>STS Transportes</span>
                </div>

                <div class="contact-image-content">
                    <img src="icon.jpg" width="200" class="img-fluid rounded" alt="Ilustración de inicio de sesión" style="max-width: 100%; margin-bottom: 2rem; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));">
                    
                    <h2 class="contact-image-title">Contáctanos</h2>
                    <p class="contact-image-text">
                        ¿Tienes preguntas o comentarios? Estamos aquí para ayudarte. 
                        Completa el formulario y nos pondremos en contacto contigo lo antes posible.
                    </p>
                    <div style="margin-top: 2rem;">
                        <div style="margin-bottom: 1rem;">
                            <i class="fas fa-phone-alt" style="margin-right: 0.5rem;"></i>
                            +52 demostracion
                        </div>
                        <div style="margin-bottom: 1rem;">
                            <i class="fas fa-envelope" style="margin-right: 0.5rem;"></i>
                            STStransportes@gmail.com
                        </div>
                        <div>
                            <i class="fas fa-map-marker-alt" style="margin-right: 0.5rem;"></i>
                            Monterrey, Nuevo León, México.
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="contact-form-col" data-aos="fade-left">
                <h1 class="contact-title"><?= Html::encode($this->title) ?></h1>
                <p class="contact-subtitle">Nos importa tu opinion, no dudes en conctactarnos</p>
                
                <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>
                    <div class="alert alert-success">
                        Gracias por contactarnos. Te responderemos lo antes posible.
                    </div>
                <?php else: ?>
                
                    <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>
                    
                        <?= $form->field($model, 'name')->textInput([
                            'class' => 'form-control',
                            'placeholder' => 'Nombre completo'
                        ]) ?>
                        
                        <?= $form->field($model, 'email')->textInput([
                            'class' => 'form-control',
                            'placeholder' => 'Correo electrónico'
                        ]) ?>
                        
                        <?= $form->field($model, 'subject')->textInput([
                            'class' => 'form-control',
                            'placeholder' => 'Asunto'
                        ]) ?>
                        
                        <?= $form->field($model, 'body')->textarea([
                            'class' => 'form-control',
                            'placeholder' => 'Mensaje',
                            'rows' => 6
                        ]) ?>

                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                            'template' => '<div class="captcha-container">{image}<i class="fas fa-sync-alt captcha-reload"></i></div>{input}',
                            'options' => ['class' => 'form-control', 'placeholder' => 'Código de verificación'],
                            'imageOptions' => ['class' => 'captcha-image']
                        ]) ?>
                        
                        <div class="form-group">
                            <?= Html::submitButton('Enviar Reporte', [
                                'class' => 'contact-btn',
                                'name' => 'contact-button'
                            ]) ?>
                        </div> 
                        
                    <?php ActiveForm::end(); ?>
                    
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="site-footer">
        <div>
            Último acceso: <?= Yii::$app->formatter->asDatetime(time(), 'dd/MM/yyyy') ?>
        </div>
        <div style="margin-top: 0.3rem;">
            &copy; <?= date('Y') ?> STS - Sistema de Gestión. Todos los derechos reservados.
        </div>
    </div>
</div>