@extends('layouts.main')
@section('title', 'Pharmacies')
@section('content')

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .form-container {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            overflow: hidden;
        }
        .form-header {
            background: linear-gradient(90deg, #3498db, #2980b9);
        }
        .form-input:focus {
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.3);
        }
        .btn-submit {
            background: linear-gradient(90deg, #3498db, #2980b9);
            transition: all 0.3s ease;
        }
        .btn-submit:hover {
            background: linear-gradient(90deg, #2980b9, #3498db);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .password-toggle {
            cursor: pointer;
            transition: color 0.3s;
        }
        .password-toggle:hover {
            color: #3498db;
        }
    </style>
</head>
<body>
    <div class="container mx-auto p-4 max-w-2xl w-full">
        <div class="form-container bg-white">
            <!-- En-tête du formulaire -->
            <div class="form-header text-white text-center py-6 px-4">
                <h1 class="text-3xl font-bold mb-2">Créer un compte</h1>
                <p class="opacity-90">Rejoignez notre plateforme en remplissant le formulaire ci-dessous</p>
            </div>
            
            <!-- Formulaire -->
            <form class="p-8 space-y-6" id="registrationForm">
                <!-- Nom complet -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom complet <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user text-gray-400"></i>
                        </div>
                        <input type="text" id="name" name="name" required
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 form-input"
                            placeholder="Votre nom complet">
                    </div>
                    <p class="mt-1 text-xs text-red-500 hidden" id="nameError">Veuillez entrer un nom valide</p>
                </div>
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse email <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-envelope text-gray-400"></i>
                        </div>
                        <input type="email" id="email" name="email" required
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 form-input"
                            placeholder="exemple@domaine.com">
                    </div>
                    <p class="mt-1 text-xs text-red-500 hidden" id="emailError">Veuillez entrer une adresse email valide</p>
                </div>
                
                <!-- Mot de passe -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="password" name="password" required
                            class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 form-input"
                            placeholder="Au moins 8 caractères">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="password-toggle fas fa-eye-slash text-gray-400" id="togglePassword"></i>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-red-500 hidden" id="passwordError">Le mot de passe doit contenir au moins 8 caractères</p>
                </div>
                
                <!-- Confirmation du mot de passe -->
                <div>
                    <label for="confirmPassword" class="block text-sm font-medium text-gray-700 mb-1">Confirmer le mot de passe <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-lock text-gray-400"></i>
                        </div>
                        <input type="password" id="confirmPassword" name="confirmPassword" required
                            class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 form-input"
                            placeholder="Retapez votre mot de passe">
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
                            <i class="password-toggle fas fa-eye-slash text-gray-400" id="toggleConfirmPassword"></i>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-red-500 hidden" id="confirmPasswordError">Les mots de passe ne correspondent pas</p>
                </div>
                
                <!-- Rôle -->
                <div>
                    <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Rôle <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <i class="fas fa-user-tag text-gray-400"></i>
                        </div>
                        <select id="role" name="role" required
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 form-input appearance-none">
                            <option value="" disabled selected>Sélectionnez votre rôle</option>
                            <option value="admin">Administrateur</option>
                            <option value="gerant">Gérant</option>
                            <option value="vendeur">Vendeur</option>
                            <option value="client">Client</option>
                        </select>
                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                            <i class="fas fa-chevron-down text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Conditions d'utilisation -->
                <div class="flex items-start">
                    <div class="flex items-center h-5">
                        <input id="terms" name="terms" type="checkbox" required
                            class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded">
                    </div>
                    <div class="ml-3 text-sm">
                        <label for="terms" class="font-medium text-gray-700">J'accepte les <a href="#" class="text-blue-600 hover:text-blue-500">conditions d'utilisation</a></label>
                        <p class="mt-1 text-xs text-red-500 hidden" id="termsError">Vous devez accepter les conditions d'utilisation</p>
                    </div>
                </div>
                
                <!-- Bouton de soumission -->
                <div>
                    <button type="submit" class="w-full btn-submit text-white py-3 px-4 rounded-lg font-semibold text-lg focus:outline-none focus:ring-4 focus:ring-blue-300">
                        S'inscrire
                    </button>
                </div>
                
                <!-- Lien de connexion -->
                <div class="text-center text-sm text-gray-600">
                    Déjà inscrit? <a href="#" class="font-medium text-blue-600 hover:text-blue-500">Connectez-vous</a>
                </div>
            </form>
        </div>
        
        <!-- Message de succès (caché par défaut) -->
        <div id="successMessage" class="hidden mt-6 p-4 bg-green-100 text-green-700 rounded-lg text-center">
            <i class="fas fa-check-circle text-4xl mb-2"></i>
            <h3 class="font-bold text-xl">Inscription réussie!</h3>
            <p>Votre compte a été créé avec succès.</p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registrationForm');
            const successMessage = document.getElementById('successMessage');
            
            // Fonctionnalité pour basculer la visibilité du mot de passe
            const togglePassword = document.getElementById('togglePassword');
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const passwordField = document.getElementById('password');
            const confirmPasswordField = document.getElementById('confirmPassword');
            
            togglePassword.addEventListener('click', function() {
                const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordField.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
            
            toggleConfirmPassword.addEventListener('click', function() {
                const type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordField.setAttribute('type', type);
                this.classList.toggle('fa-eye');
                this.classList.toggle('fa-eye-slash');
            });
            
            // Validation du formulaire
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                let isValid = true;
                
                // Validation du nom
                const name = document.getElementById('name');
                const nameError = document.getElementById('nameError');
                if (name.value.trim().length < 2) {
                    nameError.classList.remove('hidden');
                    isValid = false;
                } else {
                    nameError.classList.add('hidden');
                }
                
                // Validation de l'email
                const email = document.getElementById('email');
                const emailError = document.getElementById('emailError');
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(email.value)) {
                    emailError.classList.remove('hidden');
                    isValid = false;
                } else {
                    emailError.classList.add('hidden');
                }
                
                // Validation du mot de passe
                const password = document.getElementById('password');
                const passwordError = document.getElementById('passwordError');
                if (password.value.length < 8) {
                    passwordError.classList.remove('hidden');
                    isValid = false;
                } else {
                    passwordError.classList.add('hidden');
                }
                
                // Validation de la confirmation du mot de passe
                const confirmPassword = document.getElementById('confirmPassword');
                const confirmPasswordError = document.getElementById('confirmPasswordError');
                if (password.value !== confirmPassword.value) {
                    confirmPasswordError.classList.remove('hidden');
                    isValid = false;
                } else {
                    confirmPasswordError.classList.add('hidden');
                }
                
                // Validation des conditions
                const terms = document.getElementById('terms');
                const termsError = document.getElementById('termsError');
                if (!terms.checked) {
                    termsError.classList.remove('hidden');
                    isValid = false;
                } else {
                    termsError.classList.add('hidden');
                }
                
                // Si le formulaire est valide, afficher le message de succès
                if (isValid) {
                    form.classList.add('hidden');
                    successMessage.classList.remove('hidden');
                    
                    // Ici, vous enverriez normalement les données au serveur
                    console.log('Données du formulaire:', {
                        name: name.value,
                        email: email.value,
                        password: password.value,
                        role: document.getElementById('role').value
                    });
                }
            });
        });
    </script>
</body>
</html>
@endsection
