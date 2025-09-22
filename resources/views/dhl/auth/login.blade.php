<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="shortcut icon" href="{{asset('assets/images/profiles/dhl.png')}}" />
    <title>DHL - login</title>
    <style>
        :root {
            --primary-color: #d40511;
            --secondary-color: #d40511;
            --accent-color: #d40511;
            --error-color: #f72585;
            --success-color: #d40511;
            --light-color: #f8f9fa;
            --dark-color: #212529;
            --transition-speed: 0.3s;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            background: 
                linear-gradient(rgba(238, 206, 0, 0.1), rgba(255,226,109, 0.975)),
                url('{{ asset('assets/assets/img/backgroud.jpg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            padding: 20px;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            gap: 20px;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            width: 100%;
            max-width: 500px;
            border-radius: 16px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transform-style: preserve-3d;
            transition: all var(--transition-speed) ease;
        }

        /* Le reste du CSS reste inchangé */
        .form-container:hover {
            box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.3);
        }

        .form-header {
            text-align: center;
            margin-bottom: 10px;
        }

        .title {
            font-size: 2rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 5px;
            background: linear-gradient(to right, #4361ee, #3a0ca3);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            position: relative;
            display: inline-block;
        }

        .title::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 3px;
            background: linear-gradient(to right, #4361ee, #3a0ca3);
            border-radius: 3px;
        }

        .subtitle {
            color: #d40511;
            font-size: 0.9rem;
        }

        .input-group {
            position: relative;
            width: 100%;
            margin-bottom: 20px;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #d40511;
            transition: all var(--transition-speed) ease;
            z-index: 2;
        }

        .input-field {
            width: 100%;
            outline: none;
            border-radius: 10px;
            height: 50px;
            border: 2px solid #e9ecef;
            background: transparent;
            padding-left: 45px;
            padding-right: 15px;
            font-size: 1rem;
            transition: all var(--transition-speed) ease;
            color: var(--dark-color);
        }

        .input-field:focus {
            border-color: #d40511;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }

        .input-field:focus ~ .input-icon {
            color:#d40511;
        }

        .input-label {
            position: absolute;
            top: 15px;
            left: 45px;
            color: #adb5bd;
            transition: all var(--transition-speed) ease;
            pointer-events: none;
            background-color: transparent;
            padding: 0 5px;
            z-index: 1;
        }

        .input-field:focus ~ .input-label,
        .input-field:not(:placeholder-shown) ~ .input-label {
            top: -10px;
            left: 35px;
            font-size: 0.8rem;
            color: var(--primary-color);
            background-color: white;
            z-index: 3;
        }

        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #d40511;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
            z-index: 2;
        }

        .password-toggle:hover {
            color:#d40511;
        }

        .submit-btn {
            margin-top: 20px;
            height: 55px;
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border: none;
            outline: none;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            transition: all var(--transition-speed) ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: all 0.6s ease;
        }

        .submit-btn:hover {
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            transform: translateY(-2px);
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .error-message {
            color: var(--error-color);
            font-size: 0.85rem;
            margin-top: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
            animation: fadeIn var(--transition-speed) ease;
        }

        .success-message {
            color: var(--success-color);
            text-align: center;
            margin-bottom: 15px;
            font-weight: 500;
            animation: fadeIn var(--transition-speed) ease;
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
            color: #6c757d;
        }

        .form-footer a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 600;
            transition: all var(--transition-speed) ease;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .forgot-password {
            text-align: right;
            margin-top: -15px;
            margin-bottom: 10px;
        }

        .forgot-password a {
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.85rem;
            transition: all var(--transition-speed) ease;
        }

        .forgot-password a:hover {
            text-decoration: underline;
            color: var(--secondary-color);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-5px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @media (max-width: 576px) {
            .form-container {
                padding: 30px 20px;
            }
            
            .title {
                font-size: 1.5rem;
            }
        }

        /* Floating animation */
        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body>
    <form class="form-container animate__animated animate__fadeIn" method="POST" action="{{ route('dhl.handleLogin') }}">
        <div class="form-header">
            <img src="{{ asset('assets/images/profiles/dhl.png') }}" style="height: 50%; width:25%" alt="">
            <p class="subtitle">Entrez vos identifiants pour accéder à votre espace</p>
        </div>

        @csrf
        @method('post')

        @if (Session::get('success'))
            <div class="success-message animate__animated animate__bounceIn">
                <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
            </div>
        @endif

        @if (Session::get('error'))
            <div class="error-message animate__animated animate__shakeX">
                <i class="fas fa-exclamation-circle"></i> {{ Session::get('error') }}
            </div>
        @endif

        <!-- Email Field -->
        <div class="input-group">
            <i class="fas fa-envelope input-icon"></i>
            <input class="input-field" type="email" name="email" placeholder=" " value="{{ old('email') }}" required />
            <label class="input-label" for="email">Adresse Email</label>
            @error('email')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </div>
            @enderror
        </div>

        <!-- Password Field -->
        <div class="input-group">
            <i class="fas fa-key input-icon"></i>
            <input class="input-field" type="password" name="password" id="password" placeholder=" " required />
            <label class="input-label" for="password">Mot de passe</label>
            <i class="fas fa-eye password-toggle" id="togglePassword"></i>
            @error('password')
                <div class="error-message">
                    <i class="fas fa-exclamation-circle"></i> {{ $message }}
                </div>
            @enderror
        </div>

        <div class="forgot-password">
            <a href="#">Mot de passe oublié ?</a>
        </div>

        <button type="submit" class="submit-btn animate__animated animate__pulse animate__infinite animate__slower">
            <i class="fas fa-sign-in-alt"></i> Se connecter
        </button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password toggle functionality
            const togglePassword = document.querySelector('#togglePassword');
            const password = document.querySelector('#password');

            togglePassword.addEventListener('click', function() {
                const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
                password.setAttribute('type', type);
                this.classList.toggle('fa-eye-slash');
            });

            // SweetAlert notifications
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: '{{ Session::get('success') }}',
                    confirmButtonText: 'OK',
                    background: 'var(--light-color)',
                });
            @endif

            @if (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: '{{ Session::get('error') }}',
                    confirmButtonText: 'OK',
                    background: 'var(--light-color)',
                    
                });
            @endif

            // Add floating animation to form on hover
            const form = document.querySelector('.form-container');
            form.addEventListener('mouseenter', () => {
                form.classList.add('animate__animated', 'animate__pulse');
            });
            
            form.addEventListener('animationend', () => {
                form.classList.remove('animate__animated', 'animate__pulse');
            });
        });
    </script>
</body>
</html>