<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link rel="icon" href="{{ asset('assets/images/profiles/E-ci-logo.png') }}">
  <link rel="stylesheet" href="{{asset('authenticate/user/login.css')}}">
</head>
<body>
  <div class="login-container">
    <!-- Bouton de retour à l'accueil -->
    <button class="home-btn" onclick="window.location.href='{{ route('home') }}'">
      <i class="fas fa-home"></i>
    </button>
    
    <div class="login-header">
      <img src="{{asset('assetsHome/img/E-ci.jpg')}}" style="height: 50%; width:25%; border-radius:30%" alt="">
      <p>Connectez-vous pour accéder à votre compte</p>
    </div>
    
    <div class="login-body">
      <form method="POST" action="{{ route('handleLogin') }}">
        @csrf
        
        <div class="input-group">
          <label for="email">Adresse email</label>
          <i class="fas fa-envelope input-icon"></i>
          <input type="email" id="email" name="email" placeholder="votre@email.com" value="{{ old('email') }}" required>
          <div class="error-message" id="email-error">
            @error('email') {{ $message }} @enderror
          </div>
        </div>
        
        <div class="input-group">
          <label for="password">Mot de passe</label>
          <i class="fas fa-lock input-icon"></i>
          <input type="password" id="password" name="password" placeholder="••••••••" required>
          <i class="fas fa-eye password-toggle" id="togglePassword"></i>
          <div class="error-message" id="password-error">
            @error('password') {{ $message }} @enderror
          </div>
        </div>
        
        <div class="options">
          <div class="remember-me">
            <input type="checkbox" id="remember" name="remember">
            <label for="remember">Se souvenir de moi</label>
          </div>
          {{-- <div class="forgot-password">
            <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
          </div> --}}
        </div>
        
        <button type="submit" class="login-btn">Se connecter</button>
      </form>
      
      <div class="footer">
        Vous n'avez pas de compte ? <a href="{{ route('register') }}">S'inscrire</a>
      </div>
    </div>
  </div>

  <script>
    // Afficher les messages d'erreur s'ils existent
    document.addEventListener('DOMContentLoaded', function() {
      const emailError = document.getElementById('email-error');
      const passwordError = document.getElementById('password-error');
      
      if(emailError.textContent.trim() !== '') {
        emailError.style.display = 'block';
      }
      
      if(passwordError.textContent.trim() !== '') {
        passwordError.style.display = 'block';
      }
      
      // Animation des champs avec erreur
      const inputs = document.querySelectorAll('input');
      inputs.forEach(input => {
        input.addEventListener('input', function() {
          if(this.id === 'email' && emailError.style.display === 'block') {
            emailError.style.display = 'none';
          }
          if(this.id === 'password' && passwordError.style.display === 'block') {
            passwordError.style.display = 'none';
          }
        });
      });

      // Fonctionnalité d'affichage/masquage du mot de passe
      const togglePassword = document.getElementById('togglePassword');
      const password = document.getElementById('password');
      
      togglePassword.addEventListener('click', function() {
        // Change le type d'input
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        
        // Change l'icône
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
      });
    });


    // SweetAlert notifications
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Succès',
                    text: '{{ Session::get('success') }}',
                    confirmButtonText: 'OK',
                });
            @endif

            @if (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Erreur',
                    text: '{{ Session::get('error') }}',
                    confirmButtonText: 'OK',
                    
                });
            @endif
  </script>
</body>
</html>