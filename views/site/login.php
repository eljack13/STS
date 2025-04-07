<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Iniciar Sesión';


// Register additional CSS for the login page
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');

// Register GSAP and other animation libraries
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js');
$this->registerJsFile('https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/TextPlugin.min.js');
$this->registerJsFile('https://unpkg.com/aos@2.3.1/dist/aos.js');

// Custom CSS for elegant login form
$loginCss = <<<CSS
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
    
    .site-login {
        padding: 2rem 0;
        position: relative;
        min-height: calc(100vh - 180px);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .login-container {
        width: 100%;
        max-width: 1000px;
        margin: 0 auto;
        padding: 0;
    }
    
    .login-card {
        background: white;
        border-radius: 12px;
        box-shadow: var(--card-shadow);
        overflow: hidden;
        position: relative;
        margin: 2rem auto;
        border: 1px solid rgba(226, 232, 240, 0.8);
        max-width: 1000px;
        width: 100%;
    }
    
    .login-row {
        display: flex;
        flex-wrap: wrap;
    }
    
    .login-image-col {
        flex: 1;
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
        padding: 2rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        color: white;
        position: relative;
        overflow: hidden;
        min-height: 500px;
    }
    
    .login-image-col::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1MDAiIGhlaWdodD0iNTAwIj48ZmlsdGVyIGlkPSJub2lzZSIgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSI+PGZlVHVyYnVsZW5jZSB0eXBlPSJmcmFjdGFsTm9pc2UiIGJhc2VGcmVxdWVuY3k9IjAuNjUiIG51bU9jdGF2ZXM9IjMiIHN0aXRjaFRpbGVzPSJzdGl0Y2giIHJlc3VsdD0ibm9pc2UiLz48ZmVDb2xvck1hdHJpeCB0eXBlPSJtYXRyaXgiIHZhbHVlcz0iMCAwIDAgMCAwIDAgMCAwIDAgMCAwIDAgMCAwIDAgMCAwIDAgMC4xIDAiLz48L2ZpbHRlcj48cmVjdCB3aWR0aD0iNTAwIiBoZWlnaHQ9IjUwMCIgZmlsdGVyPSJ1cmwoI25vaXNlKSIgb3BhY2l0eT0iMC40Ii8+PC9zdmc+');
        opacity: 0.2;
        z-index: 0;
    }
    
    .login-image-content {
        position: relative;
        z-index: 1;
        text-align: center;
        max-width: 80%;
    }
    
    .login-image-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .login-image-text {
        font-size: 1.1rem;
        line-height: 1.6;
        margin-bottom: 2rem;
        opacity: 0.9;
    }
    
    .login-form-col {
        flex: 1;
        padding: 3rem 2.5rem;
        position: relative;
    }
    
    .login-title {
        font-size: 2rem;
        font-weight: 700;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
        position: relative;
        display: inline-block;
    }
    
    .login-title::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 40px;
        height: 3px;
        background: var(--accent-color);
        border-radius: 3px;
    }
    
    .login-subtitle {
        color: #718096;
        margin-bottom: 2rem;
        font-size: 1.1rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
        position: relative;
    }
    
    .form-control-wrapper {
        position: relative;
    }
    
    .form-control {
        height: 50px;
        border-radius: 8px;
        border: 1.5px solid #e2e8f0;
        padding: 0.75rem 1rem 0.75rem 3rem;
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
    
    .form-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        pointer-events: none;
        z-index: 2;
    }
    
    .form-control:focus + .form-icon {
        color: var(--accent-color);
    }
    
    .form-label {
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 0.5rem;
        display: block;
    }
    
    .form-check {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .form-check-input {
        width: 18px;
        height: 18px;
        margin-right: 0.5rem;
        border: 1.5px solid #cbd5e0;
        border-radius: 4px;
        cursor: pointer;
    }
    
    .form-check-input:checked {
        background-color: var(--accent-color);
        border-color: var(--accent-color);
    }
    
    .form-check-label {
        font-size: 0.95rem;
        color: #4a5568;
        cursor: pointer;
    }
    
    .login-btn {
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
        position: relative;
        overflow: hidden;
        margin-top: 1rem;
    }
    
    .login-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: all 0.6s ease;
    }
    
    .login-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(26, 54, 93, 0.3);
    }
    
    .login-btn:hover::before {
        left: 100%;
    }
    
    .login-btn:active {
        transform: translateY(0);
        box-shadow: 0 3px 8px rgba(26, 54, 93, 0.2);
    }
    
    .login-footer {
        margin-top: 2rem;
        text-align: center;
        color: #718096;
        font-size: 0.95rem;
    }
    
    .login-footer a {
        color: var(--accent-color);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .login-footer a:hover {
        color: var(--primary-color);
        text-decoration: underline;
    }
    
    .invalid-feedback {
        color: var(--error-color);
        font-size: 0.85rem;
        margin-top: 0.5rem;
        display: block;
    }
    
    /* Input field styling */
    .input-container {
        position: relative;
        margin-bottom: 1.5rem;
    }
    
    .input-field {
        width: 100%;
        height: 50px;
        padding: 0.75rem 1rem 0.75rem 3rem;
        border: 1.5px solid #e2e8f0;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: var(--input-shadow);
    }
    
    .input-field:focus {
        border-color: var(--accent-color);
        box-shadow: 0 0 0 3px rgba(49, 130, 206, 0.2);
        outline: none;
    }
    
    .input-label {
        position: absolute;
        left: 3rem;
        top: 50%;
        transform: translateY(-50%);
        color: #718096;
        font-size: 1rem;
        transition: all 0.3s ease;
        pointer-events: none;
        background: transparent;
    }
    
    .input-field:focus ~ .input-label,
    .input-field:not(:placeholder-shown) ~ .input-label {
        top: 0.5rem;
        left: 3rem;
        font-size: 0.75rem;
        transform: translateY(0);
        color: var(--accent-color);
        font-weight: 600;
    }
    
    .input-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
        font-size: 1.2rem;
        transition: all 0.3s ease;
        pointer-events: none;
    }
    
    .input-field:focus ~ .input-icon {
        color: var(--accent-color);
    }
    
    /* Password visibility toggle */
    .password-toggle {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
        cursor: pointer;
        font-size: 1.1rem;
        z-index: 2;
    }
    
    .password-toggle:hover {
        color: var(--accent-color);
    }
    
    /* Animated background shapes */
    .shape {
        position: absolute;
        border-radius: 50%;
        background: rgba(49, 130, 206, 0.1);
        animation: float 8s ease-in-out infinite;
    }
    
    .shape-1 {
        width: 100px;
        height: 100px;
        top: -50px;
        right: 10%;
        animation-delay: 0s;
    }
    
    .shape-2 {
        width: 150px;
        height: 150px;
        bottom: -70px;
        left: -70px;
        animation-delay: 2s;
    }
    
    .shape-3 {
        width: 70px;
        height: 70px;
        bottom: 10%;
        right: -30px;
        animation-delay: 4s;
    }
    
    @keyframes float {
        0% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
        100% { transform: translateY(0) rotate(0deg); }
    }
    
    /* Responsive styles */
    @media (max-width: 991.98px) {
        .login-row {
            flex-direction: column;
        }
        
        .login-image-col {
            min-height: 300px;
            padding: 2rem 1rem;
        }
        
        .login-form-col {
            padding: 2rem 1.5rem;
        }
        
        .login-image-title {
            font-size: 2rem;
        }
    }
    
    @media (max-width: 767.98px) {
        .login-image-col {
            min-height: 250px;
        }
        
        .login-image-title {
            font-size: 1.8rem;
        }
        
        .login-title {
            font-size: 1.8rem;
        }
    }
    
    @media (max-width: 575.98px) {
        .login-card {
            margin-top: 1rem;
        }
        
        .login-image-col {
            min-height: 200px;
        }
        
        .login-image-title {
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .login-image-text {
            font-size: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .login-form-col {
            padding: 1.5rem 1rem;
        }
        
        .login-title {
            font-size: 1.5rem;
        }
        
        .input-field {
            height: 45px;
        }
        
        .login-btn {
            height: 45px;
        }
    }
    
    /* Animation classes */
    .fade-in-up {
        animation: fadeInUp 0.6s ease forwards;
    }
    
    .fade-in-right {
        animation: fadeInRight 0.6s ease forwards;
    }
    
    .fade-in-left {
        animation: fadeInLeft 0.6s ease forwards;
    }
    
    .fade-in {
        animation: fadeIn 0.6s ease forwards;
    }
    
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes fadeInRight {
        from { opacity: 0; transform: translateX(-20px); }
        to { opacity: 1; transform: translateX(0); }
    }
    
    @keyframes fadeInLeft {
        from { opacity: 0; transform: translateX(20px); }
        to { opacity: 1; transform: translateX(0); }
    }
    
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    /* Animated wave effect */
    .wave-container {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 50px;
        overflow: hidden;
    }
    
    .wave {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 200%;
        height: 100%;
        background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg"><path d="M0 0v46.29c47.79 22.2 103.59 32.17 158 28 70.36-5.37 136.33-33.31 206.8-37.5 73.84-4.36 147.54 16.88 218.2 35.26 69.27 18 138.3 24.88 209.4 13.08 36.15-6 69.85-17.84 104.45-29.34C989.49 25 1113-14.29 1200 52.47V0z" opacity=".25" fill="white"/><path d="M0 0v15.81c13 21.11 27.64 41.05 47.69 56.24C99.41 111.27 165 111 224.58 91.58c31.15-10.15 60.09-26.07 89.67-39.8 40.92-19 84.73-46 130.83-49.67 36.26-2.85 70.9 9.42 98.6 31.56 31.77 25.39 62.32 62 103.63 73 40.44 10.79 81.35-6.69 119.13-24.28s75.16-39 116.92-43.05c59.73-5.85 113.28 22.88 168.9 38.84 30.2 8.66 59 6.17 87.09-7.5 22.43-10.89 48-26.93 60.65-49.24V0z" opacity=".5" fill="white"/><path d="M0 0v5.63C149.93 59 314.09 71.32 475.83 42.57c43-7.64 84.23-20.12 127.61-26.46 59-8.63 112.48 12.24 165.56 35.4C827.93 77.22 886 95.24 951.2 90c86.53-7 172.46-45.71 248.8-84.81V0z" fill="white"/></svg>');
        background-repeat: repeat-x;
        animation: wave 10s linear infinite;
    }
    
    @keyframes wave {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }
    
    /* Animated typing effect */
    .typing-text {
        border-right: 2px solid var(--accent-color);
        white-space: nowrap;
        overflow: hidden;
        animation: typing 3.5s steps(40, end), blink-caret 0.75s step-end infinite;
    }
    
    @keyframes typing {
        from { width: 0 }
        to { width: 100% }
    }
    
    @keyframes blink-caret {
        from, to { border-color: transparent }
        50% { border-color: var(--accent-color) }
    }
    
    /* Admin panel specific styles */
    .admin-badge {
        position: absolute;
        top: 1.5rem;
        right: 1.5rem;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    
    .admin-badge i {
        font-size: 1rem;
    }
    
    .secure-badge {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(56, 161, 105, 0.1);
        color: var(--success-color);
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.85rem;
        margin-top: 2rem;
    }
    
    .secure-badge i {
        font-size: 1rem;
    }
    
    /* Fix for remember me checkbox */
    .remember-me-wrapper {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .remember-me-wrapper input[type="checkbox"] {
        width: 18px;
        height: 18px;
        margin-right: 0.5rem;
        border: 1.5px solid #cbd5e0;
        border-radius: 4px;
        cursor: pointer;
        accent-color: var(--accent-color);
    }
    
    .remember-me-wrapper label {
        font-size: 0.95rem;
        color: #4a5568;
        cursor: pointer;
        margin-bottom: 0;
    }
    
    /* System status indicator */
    .system-status {
        position: absolute;
        bottom: 1.5rem;
        left: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.85rem;
    }
    
    .status-indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background-color: #38a169;
        position: relative;
    }
    
    .status-indicator::after {
        content: '';
        position: absolute;
        top: -4px;
        left: -4px;
        right: -4px;
        bottom: -4px;
        border-radius: 50%;
        background-color: rgba(56, 161, 105, 0.3);
        animation: pulse 2s infinite;
    }
    
    @keyframes pulse {
        0% { transform: scale(0.8); opacity: 0.7; }
        50% { transform: scale(1.2); opacity: 0.3; }
        100% { transform: scale(0.8); opacity: 0.7; }
    }
    
    /* Forgot password link */
    .forgot-password {
        text-align: right;
        margin-top: 0.5rem;
        margin-bottom: 1.5rem;
    }
    
    .forgot-password a {
        color: var(--accent-color);
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .forgot-password a:hover {
        color: var(--primary-color);
        text-decoration: underline;
    }
    
    /* Company logo */
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
    }
    
    .company-logo i {
        font-size: 1.8rem;
    }
    
    /* Login attempts counter */
    .login-attempts {
        font-size: 0.85rem;
        color: #718096;
        text-align: center;
        margin-top: 1rem;
    }
    
    /* Last login info */
    .last-login {
        font-size: 0.85rem;
        color: #718096;
        text-align: center;
        margin-top: 0.5rem;
    }
    
    .hidden-checkbox {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
}
    
    /* Fix for form alignment */
    .form-group.field-loginform-email,
    .form-group.field-loginform-password,
    .form-group.field-loginform-rememberme {
        margin-bottom: 1.5rem;
    }
    
    .help-block {
        color: var(--error-color);
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }
    
    /* Checkbox styling - FIXED */
    .checkbox-container {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
        cursor: pointer;
    }
    
    .checkbox-container input[type="checkbox"] {
        opacity: 0;
        position: absolute;
        cursor: pointer;
    }
    
    .checkbox-custom {
        width: 20px;
        height: 20px;
        background-color: white;
        border: 1.5px solid #cbd5e0;
        border-radius: 4px;
        margin-right: 10px;
        display: inline-block;
        position: relative;
        vertical-align: middle;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .checkbox-container:hover .checkbox-custom {
        border-color: var(--accent-color);
    }
    
    .checkbox-container input[type="checkbox"]:checked ~ .checkbox-custom {
        background-color: var(--accent-color);
        border-color: var(--accent-color);
    }
    
    .checkbox-custom:after {
        content: '';
        position: absolute;
        display: none;
        left: 7px;
        top: 3px;
        width: 5px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }
    
    .checkbox-container input[type="checkbox"]:checked ~ .checkbox-custom:after {
        display: block;
    }
    
    .checkbox-label {
        font-size: 0.95rem;
        color: #4a5568;
        cursor: pointer;
    }
    
    /* Success indicator for inputs */
    .input-success {
        position: absolute;
        right: 2.5rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--success-color);
        font-size: 1.1rem;
        z-index: 2;
    }
    
    /* Error indicator for inputs */
    .input-error {
        position: absolute;
        right: 2.5rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--error-color);
        font-size: 1.1rem;
        z-index: 2;
    }
CSS;

$this->registerCss($loginCss);

// Custom JavaScript for animations and interactions
$loginJs = <<<JS
    // Initialize AOS
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-out',
            once: true
        });
        
        // Password visibility toggle - FIXED
        const togglePassword = document.querySelector('.password-toggle');
        const passwordInput = document.querySelector('#loginform-password');
        
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function() {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                
                // Toggle icon
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
        }
        
        // Animated typing effect for welcome message
        const welcomeText = document.querySelector('.welcome-text');
        if (welcomeText) {
            const text = welcomeText.textContent;
            welcomeText.textContent = '';
            
            gsap.to(welcomeText, {
                duration: 2,
                text: text,
                ease: "none",
                delay: 0.5
            });
        }
        
        // Form validation animations
        const loginForm = document.getElementById('login-form');
        if (loginForm) {
            loginForm.addEventListener('submit', function(e) {
                let isValid = true;
                const emailInput = document.getElementById('loginform-email');
                const passwordInput = document.getElementById('loginform-password');
                
                // Simple validation for demo purposes
                if (emailInput && !emailInput.value.trim()) {
                    isValid = false;
                    animateError(emailInput);
                }
                
                if (passwordInput && !passwordInput.value.trim()) {
                    isValid = false;
                    animateError(passwordInput);
                }
                
                if (!isValid) {
                    e.preventDefault();
                    
                    // Shake animation for the form
                    gsap.to(loginForm, {
                        x: [-10, 10, -10, 10, 0],
                        duration: 0.5,
                        ease: "power2.inOut"
                    });
                } else {
                    // Success animation
                    const loginBtn = document.querySelector('.login-btn');
                    if (loginBtn) {
                        loginBtn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Iniciando sesión...';
                        loginBtn.disabled = true;
                    }
                }
            });
        }
        
        // Function to animate error on input
        function animateError(element) {
            gsap.to(element, {
                borderColor: 'var(--error-color)',
                boxShadow: '0 0 0 3px rgba(229, 62, 62, 0.2)',
                duration: 0.3
            });
            
            setTimeout(() => {
                gsap.to(element, {
                    borderColor: '#e2e8f0',
                    boxShadow: 'var(--input-shadow)',
                    duration: 0.3
                });
            }, 1500);
        }
        
        // Animate form elements on load
        gsap.from('.login-title', {
            opacity: 0,
            y: -20,
            duration: 0.6,
            ease: "power2.out"
        });
        
        gsap.from('.login-subtitle', {
            opacity: 0,
            y: -15,
            duration: 0.6,
            delay: 0.2,
            ease: "power2.out"
        });
        
        gsap.from('.form-group', {
            opacity: 0,
            y: 20,
            stagger: 0.1,
            duration: 0.6,
            delay: 0.3,
            ease: "power2.out"
        });
        
        gsap.from('.login-btn', {
            opacity: 0,
            y: 20,
            duration: 0.6,
            delay: 0.6,
            ease: "power2.out"
        });
        
        gsap.from('.secure-badge, .login-footer', {
            opacity: 0,
            y: 20,
            stagger: 0.1,
            duration: 0.6,
            delay: 0.7,
            ease: "power2.out"
        });
        
        // Animate background shapes
        gsap.to('.shape', {
            y: -20,
            rotation: 5,
            duration: 4,
            ease: "sine.inOut",
            repeat: -1,
            yoyo: true,
            stagger: 1
        });
        
        // Parallax effect on scroll
        window.addEventListener('scroll', function() {
            const scrollPosition = window.scrollY;
            
            gsap.to('.login-image-col', {
                y: scrollPosition * 0.05,
                duration: 0.3,
                ease: "power1.out"
            });
            
            gsap.to('.shape', {
                y: -20 + (scrollPosition * 0.03),
                duration: 0.3,
                ease: "power1.out"
            });
        });
    });
JS;

$this->registerJs($loginJs);
?>

<div class="site-login">
    <div class="login-container">
        <!-- Animated background shapes -->
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
        
        <div class="login-card" data-aos="fade-up" data-aos-duration="800">
            <div class="login-row">
                <!-- Left column with image and welcome text -->
                <div class="login-image-col" data-aos="fade-right" data-aos-duration="1000">
                    <!-- Company logo -->
                    <div class="company-logo">
                        <i class="fas fa-building"></i> STS
                    </div>
                    
                    <!-- Admin badge -->
                    <div class="admin-badge">
                        <i class="fas fa-shield-alt"></i> Panel Administrativo
                    </div>
                    
                    <div class="login-image-content">
                        <h2 class="login-image-title">Bienvenido de Nuevo</h2>
                        <p class="login-image-text welcome-text">Nos alegra verte de nuevo. Inicia sesión para acceder al panel administrativo y gestionar tu sistema.</p>
                        <img src="logo.jpg" width="200" class="img-fluid rounded" alt="Ilustración de inicio de sesión" style="max-width: 100%; margin-top: 2rem; filter: drop-shadow(0 10px 15px rgba(0,0,0,0.1));">
                    </div>
                    
                    <!-- System status indicator -->
                    <div class="system-status">
                        <div class="status-indicator"></div>
                        Sistema operativo
                    </div>
                    
                    <!-- Animated wave effect at the bottom -->
                    <div class="wave-container">
                        <div class="wave"></div>
                    </div>
                </div>
                
                <!-- Right column with login form -->
                <div class="login-form-col" data-aos="fade-left" data-aos-duration="1000">
                    <h1 class="login-title"><?= Html::encode($this->title) ?></h1>
                    <p class="login-subtitle">Ingresa tus credenciales para acceder al sistema</p>
                    
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'options' => ['class' => 'fade-in'],
                    ]); ?>
                    
                    <!-- Email input with floating label - FIXED -->
                    <div class="input-container">
                        <input type="email" id="loginform-email" class="input-field" name="LoginForm[email]" placeholder=" " autocomplete="email" autofocus>
                        <label for="loginform-email" class="input-label">Correo Electrónico</label>
                        <i class="fas fa-envelope input-icon"></i>
                        <i class="fas fa-check input-success" style="display: none;"></i>
                    </div>
                    
                    <!-- Password input with floating label - FIXED -->
                    <div class="input-container">
                        <input type="password" id="loginform-password" class="input-field" name="LoginForm[password]" placeholder=" " autocomplete="current-password">
                        <label for="loginform-password" class="input-label">Contraseña</label>
                        <i class="fas fa-lock input-icon"></i>
                        <i class="fas fa-eye password-toggle"></i>
                    </div>
                    
                  
                <!-- Remember me checkbox - FIXED -->
                                <?= $form->field($model, 'rememberMe', ['options' => ['class' => 'form-group']])
                    ->checkbox([
                        'template' => '<div class="checkbox-container">{input}<span class="checkbox-custom"></span><label for="loginform-rememberme" class="checkbox-label">Recordarme</label>{error}</div>',
                        'class' => 'hidden-checkbox',
                        'id' => 'loginform-rememberme'
                    ]) ?>
                    
                    <div class="form-group">
                        <?= Html::submitButton('Iniciar Sesión <i class="fas fa-arrow-right ml-2"></i>', [
                            'class' => 'login-btn',
                            'name' => 'login-button',
                            'id' => 'login-button',
                            'encode' => false
                        ]) ?>
                    </div>
                    
                    <?php ActiveForm::end(); ?>
                    
                    <div class="secure-badge">
                        <i class="fas fa-lock"></i> Conexión segura
                    </div>
                    
              
                    <div class="last-login">
                        Último acceso: <?= date('d/m/Y H:i') ?>
                    </div>
                    
                    <div class="login-footer">
                        <p>© <?= date('Y') ?> STS - Sistema de Gestión. Todos los derechos reservados.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Validación de campos y efectos visuales
document.addEventListener('DOMContentLoaded', function() {
    // Email validation with visual feedback
    const emailInput = document.getElementById('loginform-email');
    const emailSuccess = emailInput.parentNode.querySelector('.input-success');
    
    emailInput.addEventListener('input', function() {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (emailPattern.test(this.value)) {
            this.style.borderColor = 'var(--success-color)';
            emailSuccess.style.display = 'block';
            emailSuccess.className = 'fas fa-check input-success';
        } else {
            this.style.borderColor = this.value ? 'var(--error-color)' : '#e2e8f0';
            emailSuccess.style.display = this.value ? 'block' : 'none';
            emailSuccess.className = this.value ? 'fas fa-times input-error' : 'fas fa-check input-success';
        }
    });
    
    // Password toggle functionality - FIXED
    const passwordInput = document.getElementById('loginform-password');
    const passwordToggle = document.querySelector('.password-toggle');
    
    passwordToggle.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.className = type === 'password' ? 'fas fa-eye password-toggle' : 'fas fa-eye-slash password-toggle';
    });
    
    // Custom checkbox animation - FIXED
    const checkbox = document.getElementById('loginform-rememberme');
    const checkboxCustom = document.querySelector('.checkbox-custom');
    
    checkbox.addEventListener('change', function() {
        if (this.checked) {
            checkboxCustom.style.backgroundColor = 'var(--accent-color)';
            checkboxCustom.style.borderColor = 'var(--accent-color)';
        } else {
            checkboxCustom.style.backgroundColor = 'white';
            checkboxCustom.style.borderColor = '#cbd5e0';
        }
    });
});
</script>