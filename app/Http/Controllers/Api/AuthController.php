<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\BienvenueMail;
use App\Mail\UserCreatedMail;
use App\Models\gerant;
use App\Models\Pharmacie;
use App\Models\User;
use App\Models\Vendeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;


use Illuminate\Support\Str;

use Google_Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function googloauth2(Request $request)
    {
        // This method is not implemented in the provided code.
        // You can implement Google OAuth2 logic here if needed.
        // For example, redirecting to Google's OAuth2 authorization URL,
        // handling the callback, and exchanging the authorization code for an access token.


    }
    public function login(Request $request)
{
    try {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        if (auth()->attempt($request->only('email', 'password'))) {
            $user = auth()->user();

            // Création du token
            $token = $user->createToken('API Token')->plainTextToken;

            // Récupération du rôle
            if ($user->role === 'gerant') {
                $info = Gerant::where('id_utilisateur', $user->id)->first();
                $role = [
             'id'  => $info->id_gerant,
             'role'  => 'gerant',

                ];
            } elseif ($user->role === 'vendeur') {
                $info = Vendeur::where('id_utilisateur', $user->id)->first();
                 $role = [
             'id'  => $info->id_vendeur,
             'role'  => 'vendeur',

                ];
            } else {
                $role = null;
            }
 Mail::to(["benikasu7@gmail.com",$user->email])->send(new BienvenueMail($user));
            return response()->json([
                'message' => 'Connexion réussie',
                'user' => $user,
                'role' => $role,
                'token' => $token
            ], 200);

        } else {
            return response()->json(['message' => 'Mot de passe ou email incorrect'], 401);
        }
    } catch (\Exception $e) {
        return response()->json(['message' => 'Erreur : ' . $e->getMessage()], 500);
    }
}
 public function googleLogin(Request $request)
    {

    $request->validate([
        'id_token' => 'required|string',
    ]);

    $idToken = $request->id_token;

    $client = new Google_Client(['client_id' => env('GOOGLE_CLIENT_ID')]);
    $client->setHttpClient(new \GuzzleHttp\Client(['verify' => false]));

    try {
        // Vérifie que le token est valide
        $payload = $client->verifyIdToken($idToken);

        if (!$payload) {
            return response()->json(['error' => $client], 401);
        }

        // Infos récupérées depuis Google
        $googleId = $payload['sub'];
        $email = $payload['email'];
        $name = $payload['name'] ?? $email;

        // Crée ou récupère l’utilisateur
        $user = User::firstOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'google_id' => $googleId,
                'password' => bcrypt(Str::random(16)), // mot de passe aléatoire
                'role' => 'gerant'
            ]
        );
        if ($user->role === 'gerant') {
   $info = Gerant::firstOrCreate([
        'id_utilisateur' => $user->id
    ]);
     $role = $info ? [
        'id'   => $info->id_gerant,
        'role' => 'gerant',
    ] : null;
} elseif ($user->role === 'vendeur') {
    $info = Vendeur::firstOrCreate([
        'id_utilisateur' => $user->id
    ]);
     $role = $info ? [
        'id'   => $info->id_vendeur,
        'role' => 'vendeur',
    ] : null;
}


        // Connecte l’utilisateur
        Auth::login($user);

        // Création du token
        $token = $user->createToken('API Token')->plainTextToken;





        // Réponse similaire à login()
        return response()->json([

            'user' => $user,
            'role' => $role,
            'token' => $token
        ], 200);

    } catch (\Exception $e) {
        return response()->json(['error' => 'Erreur serveur: '.$e->getMessage()], 500);
    }
}


    /**
     * Store a newly created resource in storage.
     */
   public function registerusers(Request $request)
{
    try {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'role' => 'required|in:gerant,client',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
          // Création du token
        $token = $user->createToken('API Token')->plainTextToken;

    if ($user->role === 'gerant') {
   $info = Gerant::Create([
        'id_utilisateur' => $user->id
    ]);

     $role = $info ? [
        'id'   => $info->id_gerant,
        'role' => 'gerant',
    ] : null;
} elseif ($user->role === 'vendeur') {
    $info = Vendeur::Create([
        'id_utilisateur' => $user->id
    ]);
     $role = $info ? [
        'id'   => $info->id_vendeur,
        'role' => 'vendeur',
    ] : null;
}



        return response()->json([
            'message' => 'Utilisateur créé avec succès',
            'user' => $user,
            'role' => $role,
            'token' => $token
        ], 201);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Erreur lors de la création de l\'utilisateur: ' . $e->getMessage()], 500);
    }
}


    /**
     * Display the specified resource.
     */
    public function show()
    {
        try {
            $user = User::all();
            return response()->json(['user' => $user], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Utilisateur non trouvé: ' . $e->getMessage()], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function registerVendeur(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                //'password' => 'required|string|min:8',
                'id_pharmacie' => 'required|exists:pharmacies,id_pharmacie',

            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt('Opharma2024!'), // Mot de passe par défaut
                'role' => 'vendeur',
            ]);
            $vendeur = Vendeur::create([
                'id_pharmacie' => $request->id_pharmacie,
                'id_utilisateur' => $user->id,
            ]);

            $token = Password::createToken($user);
        $url = url("/reset-password/{$token}?email={$user->email}"); // Store the plain password for email
         Mail::to(["benikasu7@gmail.com",$user->email])->send(new UserCreatedMail($user, $url));

            return response()->json(['message' => 'Vendeur créé avec succès', 'vendeur' => $user, 'info'=>$vendeur], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur lors de la création du vendeur: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout(Request $request)
    {
      try {
          $request->user()->tokens()->delete(); // Supprime tous les tokens

        return response()->json([
            'message' => 'Déconnexion réussie'
        ],201);
      } catch (\Throwable $th) {
        return response()->json([
            'error' => 'Une erreur est survenue lors de la déconnexion.',
        ], 500);
      }
    }
     public function forgetpassword (Request $request){
        try {
            $request->validate([
                'email' => 'required|email',
            ]);

            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status == Password::RESET_LINK_SENT
                        ? response()->json(['message' => __($status)], 200)
                        : response()->json(['error' => __($status)], 400);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur : ' . $e->getMessage()], 500);
        }
     }
     public function resetpassword_two(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required',
                'email' => 'required|email',
                'password' => 'required|confirmed|min:8',
            ]);
            $status = Password::reset(
                $request->only('email', 'password', 'password_confirmation', 'token'),
                function (User $user) use ($request) {
                    $user->forceFill([
                        'password' => bcrypt($request->password),
                        'remember_token' => Str::random(60),
                    ])->save();
                }
            );
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erreur : ' . $e->getMessage()], 500);
        }
    }


    //fackedata controller
     public function pharmacie(Request $request)
    {
        try {
            $request->validate([
                'nom' => 'required|string|max:255',

                'adresse' => 'required|string|max:255',
                'telephone' => 'required|string|max:15',
                'indice' => 'nullable|numeric',
                'id_gerant' => 'required|exists:gerants,id_gerant',
            ]);

            // Assuming you have a Pharmacie model to handle the database logic
            $pharmacie = Pharmacie::create($request->all());

            return response()->json(['message' => 'Pharmacie created successfully', 'pharmacie' => $pharmacie], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }





      // 📩 Étape 1 : envoyer le lien de réinitialisation
    public function sendResetLink(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Lien de réinitialisation envoyé.'], 200);
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }

    // 🔁 Étape 2 : Réinitialiser le mot de passe
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'token' => 'required|string',
            'password' => 'required|min:6|confirmed',
        ]);

        $status = Password::reset(
            $request->only('email', 'token', 'password', 'password_confirmation'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                    'remember_token' => Str::random(60),
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Mot de passe réinitialisé avec succès.'], 200);
        }

        throw ValidationException::withMessages([
            'email' => [trans($status)],
        ]);
    }
     public function profilePhoto(Request $request)
    {
        return response()->json([
            'data' => $request->user()->loadMissing('profilePhoto')
        ]);
    }

   

public function updateProfile(Request $request)
{
    try {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($request->user()->id),
            ],
        ]);

        $request->user()->update($validated);

        return response()->json([
            'message' => 'Profil mis à jour',
            'data' => $request->user()->fresh()
        ], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Erreur : ' . $e->getMessage()], 500);
    }
}


    public function changePassword(Request $request)
    {
        // Validation des données
        $validator = Validator::make($request->all(), [
            'current_password' => ['required', 'string'],
            'new_password' => ['required', 'string'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation error',
                'errors' => $validator->errors()
            ], 422);
        }

        $user = $request->user();

        // Vérifie le mot de passe actuel
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'Le mot de passe actuel est incorrect'
            ], 401);
        }

        // Met à jour le mot de passe
        $user->update([
            'password' => Hash::make($request->new_password)
        ]);

        return response()->json([
            'message' => 'Mot de passe mis à jour avec succès'
        ],200);
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048',
        ]);

        $path = $request->file('photo')->store('profile-photos');

        if ($oldPhoto = $request->user()->profile_photo_path) {
            //Storage::delete($oldPhoto);
        }

        $request->user()->update([
            'profile_photo_path' => $path
        ]);

        return response()->json([
            'message' => 'Photo de profil mise à jour',
         //   'photo_url' => Storage::url($path)
        ]);
    }

    public function getClients()
    {
        // $clients = Client::with('user')->get();// relation directe

        // return response()->json([
        //     'message' => 'Clients de l’utilisateur connecté',
        //     'data' => ClientResource::collection($clients),
        // ]);

    }
}
