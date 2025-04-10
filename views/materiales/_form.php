<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\TblMateriales $model */
/** @var yii\widgets\ActiveForm $form */

$this->registerCssFile('https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js', ['position' => \yii\web\View::POS_END]);
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.4/gsap.min.js', ['position' => \yii\web\View::POS_END]);
$this->registerJsFile('https://cdn.jsdelivr.net/npm/sweetalert2@11', ['position' => \yii\web\View::POS_END]);
$this->registerCssFile('https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/flatpickr', ['position' => \yii\web\View::POS_END]);

$this->title = $model->isNewRecord ? 'Nuevo Material' : 'Actualizar Material: ' . $model->tbl_materiales_nombre;
?>

<div class="inventory-container">
    <div class="inventory-header" data-aos="fade-down" data-aos-duration="800">
        <h1 class="inventory-title"><?= Html::encode($this->title) ?></h1>
        <div class="inventory-decoration"></div>
    </div>

    <div class="tbl-materiales-form card" data-aos="zoom-in" data-aos-delay="300" data-aos-duration="1000">
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                'id' => 'materiales-form',
                'options' => ['class' => 'elegant-form'],
            ]); ?>

            <div class="form-row" data-aos="fade-right" data-aos-delay="400">
                <?= $form->field($model, 'tbl_materiales_nombre', [
                    'options' => ['class' => 'form-group form-field'],
                    'template' => "{label}\n<div class='input-wrapper'>{input}</div>\n{error}",
                    'labelOptions' => ['class' => 'form-label'],
                ])->textInput(['maxlength' => true, 'class' => 'form-control', 'placeholder' => 'Nombre del material']) ?>
            </div>

            <div class="form-row" data-aos="fade-right" data-aos-delay="500">
                <?= $form->field($model, 'tbl_materiales_descripcion', [
                    'options' => ['class' => 'form-group form-field'],
                    'template' => "{label}\n<div class='input-wrapper'>{input}</div>\n{error}",
                    'labelOptions' => ['class' => 'form-label'],
                ])->textarea(['rows' => 3, 'class' => 'form-control', 'placeholder' => 'Descripción detallada']) ?>
            </div>

            <div class="form-row two-columns">
                <div class="column" data-aos="fade-right" data-aos-delay="600">
                    <?= $form->field($model, 'tbl_materiales_codigo', [
                        'options' => ['class' => 'form-group form-field'],
                        'template' => "{label}\n<div class='input-wrapper'>{input}</div>\n{error}",
                        'labelOptions' => ['class' => 'form-label'],
                    ])->textInput(['maxlength' => true, 'class' => 'form-control', 'placeholder' => 'Código único']) ?>
                </div>
                <div class="column" data-aos="fade-right" data-aos-delay="700">
                    <?= $form->field($model, 'tbl_materiales_cantidad', [
                        'options' => ['class' => 'form-group form-field'],
                        'template' => "{label}\n<div class='input-wrapper'>{input}</div>\n{error}",
                        'labelOptions' => ['class' => 'form-label'],
                    ])->textInput(['type' => 'number', 'class' => 'form-control', 'placeholder' => 'Cantidad disponible']) ?>
                </div>
            </div>

            <div class="form-row two-columns">
                <div class="column" data-aos="fade-right" data-aos-delay="800">
                    <?= $form->field($model, 'tbl_materiales_fechaingreso', [
                        'options' => ['class' => 'form-group form-field'],
                        'template' => "{label}\n<div class='input-wrapper date-input-wrapper'><i class='date-icon'></i>{input}</div>\n{error}",
                        'labelOptions' => ['class' => 'form-label'],
                    ])->textInput(['class' => 'form-control datepicker', 'placeholder' => 'Seleccione fecha']) ?>
                </div>
                <div class="column" data-aos="fade-right" data-aos-delay="900">
                    <?= $form->field($model, 'tbl_materiales_created', [
                        'options' => ['class' => 'form-group form-field'],
                        'template' => "{label}\n<div class='input-wrapper date-input-wrapper'><i class='date-icon'></i>{input}</div>\n{error}",
                        'labelOptions' => ['class' => 'form-label'],
                    ])->textInput(['class' => 'form-control datepicker', 'placeholder' => 'Fecha de creación']) ?>
                </div>
            </div>

            <div class="form-row" data-aos="fade-right" data-aos-delay="1000">
                <?= $form->field($model, 'tbl_materiales_createdby', [
                    'options' => ['class' => 'form-group form-field'],
                    'template' => "{label}\n<div class='input-wrapper'>{input}</div>\n{error}",
                    'labelOptions' => ['class' => 'form-label'],
                ])->textInput(['maxlength' => true, 'class' => 'form-control', 'placeholder' => 'Creado por']) ?>
            </div>

            <div class="form-actions" data-aos="fade-up" data-aos-delay="1100">
                <button type="button" class="btn btn-outline cancel-btn">Cancelar</button>
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-primary save-btn']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<style>
:root {
    --primary-color: #4361ee;
    --primary-light: #4895ef;
    --secondary-color: #3f37c9;
    --text-color: #333;
    --text-light: #555;
    --background-color: #f8f9fa;
    --card-color: #fff;
    --border-color: #e0e0e0;
    --border-focus: #4361ee;
    --error-color: #e63946;
    --success-color: #2a9d8f;
    --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px rgba(0, 0, 0, 0.1);
    --transition: all 0.3s ease;
}

body {
    background-color: var(--background-color);
    color: var(--text-color);
    font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', sans-serif;
}

.inventory-container {
    max-width: 1000px;
    margin: 2rem auto;
    padding: 0 1.5rem;
}

.inventory-header {
    text-align: center;
    margin-bottom: 2.5rem;
}

.inventory-title {
    font-size: 2.2rem;
    font-weight: 600;
    color: var(--primary-color);
    margin-bottom: 0.5rem;
}

.inventory-decoration {
    height: 4px;
    width: 80px;
    background: linear-gradient(to right, var(--primary-color), var(--primary-light));
    margin: 0 auto;
    border-radius: 2px;
}

.card {
    background-color: var(--card-color);
    border-radius: 12px;
    box-shadow: var(--shadow-lg);
    overflow: hidden;
    border: none;
    transition: var(--transition);
}

.card:hover {
    box-shadow: 0 15px 25px rgba(0, 0, 0, 0.15);
    transform: translateY(-5px);
}

.card-body {
    padding: 2.5rem;
}

.elegant-form .form-row {
    margin-bottom: 1.5rem;
}

.elegant-form .two-columns {
    display: flex;
    gap: 1.5rem;
}

.elegant-form .column {
    flex: 1;
}

.elegant-form .form-label {
    display: block;
    margin-bottom: 0.5rem;
    font-weight: 500;
    color: var(--text-color);
    font-size: 0.95rem;
    transition: var(--transition);
}

.elegant-form .input-wrapper {
    position: relative;
    transition: var(--transition);
}

.elegant-form .form-control {
    width: 100%;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    background-color: #fff;
    transition: var(--transition);
    box-shadow: var(--shadow-sm);
}

.elegant-form .form-control:focus {
    border-color: var(--border-focus);
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
    outline: none;
}

.elegant-form .help-block {
    margin-top: 0.5rem;
    font-size: 0.85rem;
    color: var(--error-color);
}

.elegant-form .form-actions {
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    margin-top: 2rem;
}

.elegant-form .btn {
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    font-weight: 500;
    border-radius: 8px;
    transition: var(--transition);
    cursor: pointer;
}

.elegant-form .btn-outline {
    background-color: transparent;
    border: 1px solid var(--border-color);
    color: var(--text-color);
}

.elegant-form .btn-outline:hover {
    background-color: #f1f1f1;
}

.elegant-form .btn-primary {
    background: linear-gradient(to right, var(--primary-color), var(--primary-light));
    border: none;
    color: white;
    box-shadow: 0 4px 10px rgba(67, 97, 238, 0.3);
}

.elegant-form .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(67, 97, 238, 0.4);
}

.elegant-form .save-btn {
    min-width: 120px;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .elegant-form .two-columns {
        flex-direction: column;
        gap: 1rem;
    }
    
    .card-body {
        padding: 1.5rem;
    }
    
    .inventory-title {
        font-size: 1.8rem;
    }
}

/* Animation classes */
.form-field {
    transition: transform 0.4s ease, opacity 0.4s ease;
}

.form-field:hover {
    transform: translateX(5px);
}

.input-wrapper {
    position: relative;
    overflow: hidden;
}

.input-wrapper::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(to right, var(--primary-color), var(--primary-light));
    transform: scaleX(0);
    transform-origin: right;
    transition: transform 0.4s ease;
}

.input-wrapper:hover::after,
.form-control:focus + .input-wrapper::after {
    transform: scaleX(1);
    transform-origin: left;
}

/* Date input styling */
.date-input-wrapper {
    position: relative;
}

.date-icon {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    width: 18px;
    height: 18px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%234361ee' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Crect x='3' y='4' width='18' height='18' rx='2' ry='2'%3E%3C/rect%3E%3Cline x1='16' y1='2' x2='16' y2='6'%3E%3C/line%3E%3Cline x1='8' y1='2' x2='8' y2='6'%3E%3C/line%3E%3Cline x1='3' y1='10' x2='21' y2='10'%3E%3C/line%3E%3C/svg%3E");
    background-size: contain;
    background-repeat: no-repeat;
    pointer-events: none;
    z-index: 2;
}

.elegant-form .datepicker {
    padding-right: 40px;
    cursor: pointer;
    background-color: #fff;
    transition: all 0.3s ease;
}

.elegant-form .datepicker:focus {
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.15);
}

/* Flatpickr customization */
.flatpickr-calendar {
    border-radius: 8px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    border: none;
    overflow: hidden;
}

.flatpickr-day.selected, 
.flatpickr-day.startRange, 
.flatpickr-day.endRange, 
.flatpickr-day.selected.inRange, 
.flatpickr-day.startRange.inRange, 
.flatpickr-day.endRange.inRange, 
.flatpickr-day.selected:focus, 
.flatpickr-day.startRange:focus, 
.flatpickr-day.endRange:focus, 
.flatpickr-day.selected:hover, 
.flatpickr-day.startRange:hover, 
.flatpickr-day.endRange:hover, 
.flatpickr-day.selected.prevMonthDay, 
.flatpickr-day.startRange.prevMonthDay, 
.flatpickr-day.endRange.prevMonthDay, 
.flatpickr-day.selected.nextMonthDay, 
.flatpickr-day.startRange.nextMonthDay, 
.flatpickr-day.endRange.nextMonthDay {
    background: var(--primary-color);
    border-color: var(--primary-color);
}

.flatpickr-day.selected.startRange + .endRange:not(:nth-child(7n+1)), 
.flatpickr-day.startRange.startRange + .endRange:not(:nth-child(7n+1)), 
.flatpickr-day.endRange.startRange + .endRange:not(:nth-child(7n+1)) {
    box-shadow: -10px 0 0 var(--primary-color);
}

.flatpickr-months .flatpickr-month {
    background: var(--primary-color);
}

.flatpickr-months .flatpickr-prev-month, 
.flatpickr-months .flatpickr-next-month {
    fill: #fff;
}

.flatpickr-current-month .flatpickr-monthDropdown-months,
.flatpickr-current-month input.cur-year {
    color: #fff;
}

.flatpickr-time .flatpickr-am-pm:hover,
.flatpickr-time .flatpickr-am-pm:focus {
    background: #f0f0f0;
}

.flatpickr-time input:hover, 
.flatpickr-time .flatpickr-am-pm:hover, 
.flatpickr-time input:focus, 
.flatpickr-time .flatpickr-am-pm:focus {
    background: #f0f0f0;
}

.flatpickr-day.today {
    border-color: var(--primary-color);
}

.flatpickr-day.today:hover, 
.flatpickr-day.today:focus {
    border-color: var(--primary-color);
    background: rgba(67, 97, 238, 0.1);
}

.flatpickr-day:hover {
    background: rgba(67, 97, 238, 0.1);
}
</style>

<?php
$js = <<<JS
// Initialize AOS
AOS.init({
    once: false,
    mirror: true
});

// Initialize Flatpickr for date inputs with better configuration
flatpickr(".datepicker", {
    dateFormat: "Y-m-d",
    allowInput: true,
    animate: true,
    disableMobile: false,
    monthSelectorType: "static",
    position: "auto",
    showMonths: 1,
    static: true,
    time_24hr: true,
    weekNumbers: false,
    wrap: false,
    onChange: function(selectedDates, dateStr, instance) {
        // Add animation when date is selected
        const input = instance.input;
        gsap.fromTo(input, 
            { backgroundColor: "rgba(67, 97, 238, 0.1)" },
            { backgroundColor: "#fff", duration: 0.5, ease: "power2.out" }
        );
    },
    onOpen: function(selectedDates, dateStr, instance) {
        // Animation when calendar opens
        const calendar = instance.calendarContainer;
        gsap.fromTo(calendar, 
            { opacity: 0, y: -10 },
            { opacity: 1, y: 0, duration: 0.3, ease: "power2.out" }
        );
    }
});

// GSAP animations
document.addEventListener('DOMContentLoaded', function() {
    // Initial animations
    gsap.from('.inventory-title', {
        duration: 1,
        y: -50,
        opacity: 0,
        ease: 'power3.out'
    });
    
    gsap.from('.inventory-decoration', {
        duration: 1.2,
        width: 0,
        delay: 0.3,
        ease: 'power3.inOut'
    });
    
    // Form field animations on focus
    const formFields = document.querySelectorAll('.form-control');
    
    formFields.forEach(field => {
        field.addEventListener('focus', function() {
            gsap.to(this.closest('.form-field'), {
                duration: 0.3,
                scale: 1.02,
                ease: 'power2.out'
            });
        });
        
        field.addEventListener('blur', function() {
            gsap.to(this.closest('.form-field'), {
                duration: 0.3,
                scale: 1,
                ease: 'power2.out'
            });
        });
    });
    
    // Button hover animations
    const saveBtn = document.querySelector('.save-btn');
    
    saveBtn.addEventListener('mouseenter', function() {
        gsap.to(this, {
            duration: 0.3,
            scale: 1.05,
            ease: 'power2.out'
        });
    });
    
    saveBtn.addEventListener('mouseleave', function() {
        gsap.to(this, {
            duration: 0.3,
            scale: 1,
            ease: 'power2.out'
        });
    });
    
    // Form submission with SweetAlert
    const form = document.getElementById('materiales-form');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Show loading animation
        Swal.fire({
            title: 'Guardando...',
            text: 'Procesando la información',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        // Simulate form submission (replace with actual AJAX submission)
        setTimeout(() => {
            // Submit the form
            this.submit();
            
            // Show success message (this would normally be in the success callback)
            Swal.fire({
                icon: 'success',
                title: '¡Guardado con éxito!',
                text: 'El material ha sido registrado correctamente',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true
            });
        }, 1500);
    });
    
    // Cancel button
    document.querySelector('.cancel-btn').addEventListener('click', function() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Perderás los cambios no guardados",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3f37c9',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, salir',
            cancelButtonText: 'No, continuar'
        }).then((result) => {
            if (result.isConfirmed) {
                window.history.back();
            }
        });
    });
    
    // Scroll animations
    window.addEventListener('scroll', function() {
        const scrollPosition = window.scrollY;
        
        if (scrollPosition > 100) {
            gsap.to('.card', {
                duration: 0.5,
                boxShadow: '0 20px 30px rgba(0, 0, 0, 0.15)',
                ease: 'power2.out'
            });
        } else {
            gsap.to('.card', {
                duration: 0.5,
                boxShadow: '0 10px 15px rgba(0, 0, 0, 0.1)',
                ease: 'power2.out'
            });
        }
    });
});
JS;

$this->registerJs($js);
?>

