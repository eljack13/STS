<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\Materiales */
/* @var $form yii\widgets\ActiveForm */

// ========== SECCIÓN: REGISTRO DE DEPENDENCIAS ==========
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');
$this->registerJsFile('https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js');
// Registramos SweetAlert2
$this->registerJsFile('https://cdn.jsdelivr.net/npm/sweetalert2@11');
?>

<div class="materiales-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <!-- ========== SECCIÓN: CAMPO PARA EL CÓDIGO DE BARRAS ========== -->
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'tbl_materiales_cantidad')->textInput([
                'maxlength' => true, 
                'id' => 'codigo-material',
                'placeholder' => 'Ingrese o escanee un código'
            ]) ?>
        </div>
        <div class="col-md-6">
            <!-- Botones para escanear o ingresar manualmente -->
            <div class="scanner-buttons">
                <button type="button" class="btn btn-primary scanner-button" id="btn-scan-barcode">
                    <i class="fa fa-barcode"></i> Escanear código de barras
                </button>
                <button type="button" class="btn btn-secondary scanner-button" id="btn-manual-input">
                    <i class="fa fa-keyboard"></i> Ingresar manualmente
                </button>
            </div>
        </div>
    </div>
    
    <!-- ========== SECCIÓN: ESCÁNER DE CÓDIGOS DE BARRAS ========== -->
    <div id="barcode-scanner" style="display:none;">
        <div class="card">
            <!-- Encabezado del escáner -->
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="fa fa-camera"></i> Escáner de Códigos de Barras
                    <button type="button" class="close text-white" id="btn-close-scanner" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </h5>
            </div>
            
            <!-- Cuerpo del escáner -->
            <div class="card-body">
                <!-- El elemento donde se mostrará la cámara -->
                <div id="reader" style="width:100%;"></div>
                
                <!-- Instrucciones para el usuario -->
                <div class="scanner-instructions mt-3">
                    <p class="mb-0"><i class="fa fa-info-circle"></i> Posiciona el código de barras frente a la cámara.</p>
                </div>
                
                <!-- Área para mostrar el estado del escáner -->
                <div class="scan-status" id="scan-status">
                    Esperando código de barras...
                </div>
                
                <!-- Botones de control del escáner -->
                <div class="mt-3">
                    <button type="button" class="btn btn-danger" id="btn-stop-scanning">
                        <i class="fa fa-times"></i> Detener escaneo
                    </button>
                    <button type="button" class="btn btn-info ml-2" id="btn-switch-camera">
                        <i class="fa fa-sync"></i> Cambiar cámara
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== SECCIÓN: OTROS CAMPOS DEL FORMULARIO ========== -->
    <div class="row mt-4">
        <div class="col-md-6">
            <?= $form->field($model, 'tbl_materiales_nombre')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'tbl_materiales_id')->textInput() ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'tbl_materiales_descripcion')->textarea(['rows' => 4]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'tbl_materiales_fechaingreso')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'tbl_materiales_created')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <!-- Botón para enviar el formulario -->
    <div class="form-group mt-4">
        <?= Html::submitButton('Guardar', ['class' => 'btn btn-success btn-lg']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
// ========== SECCIÓN: ESTILOS CSS ========== 
$css = <<<CSS
    /* --- Estilos para el indicador de estado del escáner --- */
    .scan-status {
        margin-top: 10px;
        padding: 5px 10px;
        border-radius: 4px;
        background: #f8f9fa;
        border-left: 4px solid #17a2b8;
        font-weight: bold;
    }
    
    /* --- Estilos para los botones del escáner --- */
    .scanner-buttons {
        display: flex;
        gap: 10px;
        margin-top: 32px;
    }
    
    .scanner-button {
        flex: 1;
    }
    
    /* --- Estilos para el área de visualización del escáner --- */
    #reader {
        border: 2px dashed #ccc;
        border-radius: 5px;
        overflow: hidden;
        max-width: 100%;
    }
    
    #reader video {
        max-width: 100%;
        height: auto;
    }
    
    /* --- Mejoras para la interfaz de la biblioteca Html5-QRCode --- */
    #reader__scan_region img {
        display: none;
    }
    
    #reader__dashboard_section_csr button {
        border-radius: 4px;
        border: 1px solid #ccc;
        padding: 5px 10px;
        background: #f8f9fa;
        margin: 5px;
    }
    
    #reader__dashboard_section_csr select {
        padding: 5px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin: 5px;
    }
CSS;

$this->registerCss($css);

// ========== SECCIÓN: JAVASCRIPT ========== 
$js = <<<'JS'
/**
 * ESCÁNER DE CÓDIGOS DE BARRAS
 * 
 * Este código implementa un escáner de códigos de barras utilizando la biblioteca Html5-QRCode.
 * Permite escanear códigos desde la cámara del dispositivo y controlar la sesión de escaneo.
 * Integra SweetAlert2 para mostrar notificaciones atractivas.
 */

// ===== CONFIGURACIONES Y VARIABLES GLOBALES =====
let html5QrCode = null;     // Instancia del escáner
let scannerActive = false;  // Estado actual del escáner
let currentCamera = 'environment'; // Cámara en uso (trasera por defecto)

// ===== FUNCIONES PRINCIPALES DEL ESCÁNER =====

/**
 * Inicia el escáner de códigos de barras
 * Muestra la interfaz, inicializa la instancia Html5-QRCode y activa la cámara
 */
async function startScanner() {
    // Preparar la interfaz
    $('#barcode-scanner').show();
    $('#btn-scan-barcode').hide();
    $('#scan-status').text('Iniciando cámara...');
    
    try {
        // 1. Crear la instancia del escáner
        html5QrCode = new Html5Qrcode("reader");
        
        // 2. Configurar el escáner para un rendimiento óptimo
        const config = {
            fps: 5, // Frames por segundo (valor reducido para mejor rendimiento)
            qrbox: {
                width: 450,
                height: 450
            },
            // Formatos de códigos soportados
            formatsToSupport: [
                // Códigos de barras estándar
                Html5QrcodeSupportedFormats.EAN_13,
                Html5QrcodeSupportedFormats.EAN_8,
                Html5QrcodeSupportedFormats.CODE_39,
                Html5QrcodeSupportedFormats.CODE_93,
                Html5QrcodeSupportedFormats.CODE_128,
                Html5QrcodeSupportedFormats.ITF,
                Html5QrcodeSupportedFormats.UPC_A,
                Html5QrcodeSupportedFormats.UPC_E
            ]
        };
        
        // 3. Iniciar el escáner con la cámara seleccionada
        await html5QrCode.start(
            { facingMode: currentCamera },
            config,
            onScanSuccess,
            onScanProgress
        );
        
        // 4. Actualizar el estado
        scannerActive = true;
        $('#scan-status').text('Escáner activo. Dirija el código a la cámara.');
        
        // 5. Listar cámaras disponibles (para posible cambio)
        Html5Qrcode.getCameras()
            .then(devices => {
                console.log("Cámaras disponibles:", devices.length);
            })
            .catch(err => {
                console.warn("No se pudieron enumerar cámaras:", err);
            });
        
    } catch (err) {
        // Manejo de errores durante la inicialización
        console.error("Error al iniciar el escáner:", err);
        
        // Mostrar error con SweetAlert
        Swal.fire({
            icon: 'error',
            title: 'Error al iniciar el escáner',
            text: err.message,
            confirmButtonColor: '#3085d6'
        });
        
        stopScanner();
    }
}

/**
 * Detiene el escáner y restaura la interfaz
 */
function stopScanner() {
    if (html5QrCode && scannerActive) {
        // Intentar detener el escáner correctamente
        html5QrCode.stop()
            .then(() => {
                scannerActive = false;
                $('#scan-status').text('Escáner detenido.');
            })
            .catch(err => {
                console.warn("Error al detener el escáner:", err);
            });
    }
    
    // Restaurar interfaz independientemente del resultado
    $('#barcode-scanner').hide();
    $('#btn-scan-barcode').show();
}

/**
 * Cambia entre cámara frontal y trasera
 */
async function switchCamera() {
    if (!html5QrCode || !scannerActive) return;
    
    // Cambiar el tipo de cámara
    currentCamera = currentCamera === 'environment' ? 'user' : 'environment';
    $('#scan-status').text('Cambiando cámara...');
    
    try {
        // 1. Detener el escáner actual
        await html5QrCode.stop();
        
        // 2. Configurar el escáner con los mismos parámetros
        const config = {
            fps: 5,
            qrbox: {
                width: 250,
                height: 150
            },
            formatsToSupport: [
                Html5QrcodeSupportedFormats.EAN_13,
                Html5QrcodeSupportedFormats.EAN_8,
                Html5QrcodeSupportedFormats.CODE_39,
                Html5QrcodeSupportedFormats.CODE_93,
                Html5QrcodeSupportedFormats.CODE_128
            ]
        };
        
        // 3. Reiniciar con la nueva cámara
        await html5QrCode.start(
            { facingMode: currentCamera },
            config,
            onScanSuccess,
            onScanProgress
        );
        
        // 4. Actualizar estado
        $('#scan-status').text("Escáner activo. Usando cámara " + (currentCamera === 'user' ? 'frontal' : 'trasera') + ".");
    } catch (err) {
        console.error("Error al cambiar de cámara:", err);
        
        // Mostrar error con SweetAlert
        Swal.fire({
            icon: 'error',
            title: 'Error al cambiar cámara',
            text: err.message,
            confirmButtonColor: '#3085d6'
        });
        
        stopScanner();
    }
}

// ===== MANEJADORES DE EVENTOS DEL ESCÁNER =====

/**
 * Se ejecuta cuando se detecta un código correctamente
 * @param {string} decodedText - El texto del código detectado
 * @param {object} decodedResult - El resultado completo de la detección
 */
function onScanSuccess(decodedText, decodedResult) {
    console.log("¡Código detectado!", decodedText);
    
    // 1. Reproducir sonido de confirmación
    try {
        const beep = new Audio("data:audio/wav;base64,UklGRl9vT19XQVZFZm10IBAAAAABAAEAQB8AAEAfAAABAAgAZGF0YU");
        beep.play();
    } catch (e) {
        console.warn("No se pudo reproducir el sonido de confirmación");
    }
    
    // 2. Colocar el código en el campo del formulario
    $('#codigo-material').val(decodedText);
    
    // 3. Notificar al usuario
    $('#scan-status').text('¡Código detectado!');
    
    // 4. Detener el escáner (ya cumplió su función)
    stopScanner();
    
    // 5. Mostrar notificación con SweetAlert
    Swal.fire({
        icon: 'success',
        title: '¡Código detectado!',
        text: 'Se ha detectado el código: ' + decodedText,
        showConfirmButton: true,
        timer: 3000,
        timerProgressBar: true,
        confirmButtonColor: '#28a745',
        confirmButtonText: 'Aceptar'
    });
}

/**
 * Se ejecuta durante el proceso de escaneo (manejo silencioso de errores)
 */
function onScanProgress(errorMessage, error) {
    // Esta función queda vacía intencionalmente para evitar mensajes constantes
}

/**
 * Muestra un mensaje de error utilizando SweetAlert
 * @param {string} title - Título del mensaje
 * @param {string} message - Contenido del mensaje
 */
function showError(title, message) {
    Swal.fire({
        icon: 'error',
        title: title,
        text: message,
        confirmButtonColor: '#dc3545'
    });
}

// ===== ASIGNACIÓN DE EVENTOS A ELEMENTOS DE LA INTERFAZ =====

// Botón para iniciar el escaneo
$('#btn-scan-barcode').on('click', function(e) {
    e.preventDefault();
    startScanner();
});

// Botones para detener el escaneo
$('#btn-stop-scanning, #btn-close-scanner').on('click', function(e) {
    e.preventDefault();
    stopScanner();
});

// Botón para ingreso manual
$('#btn-manual-input').on('click', function(e) {
    e.preventDefault();
    stopScanner();
    $('#codigo-material').focus();
    
    // Mostrar un mensaje indicando que puede ingresar manualmente
    Swal.fire({
        icon: 'info',
        title: 'Ingreso manual',
        text: 'Puede ingresar el código manualmente en el campo correspondiente',
        showConfirmButton: true,
        confirmButtonColor: '#17a2b8',
        timer: 2000,
        position: 'top-end',
        toast: true
    });
});

// Botón para cambiar de cámara
$('#btn-switch-camera').on('click', function(e) {
    e.preventDefault();
    switchCamera();
});

// Evento para detener el escaneo al enviar el formulario
$('form').on('submit', function() {
    stopScanner();
});

// Tecla ESC para cancelar el escaneo
$(document).on('keyup', function(e) {
    if (e.key === 'Escape' && scannerActive) {
        stopScanner();
    }
});

// Mostrar mensaje de bienvenida al cargar la página
$(document).ready(function() {
    // Mensaje de inicio opcional
    Swal.fire({
        icon: 'info',
        title: 'Escáner de códigos listo',
        text: 'Pulse el botón "Escanear código de barras" cuando necesite leer un código',
        showConfirmButton: false,
        timer: 3000,
        position: 'top-end',
        toast: true
    });
});
JS;

$this->registerJs($js);
?>