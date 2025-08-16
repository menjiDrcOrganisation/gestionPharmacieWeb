<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gerant;
use App\Models\Pharmacie;
use App\Models\User;
use App\Models\Vendeur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Str;

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
                $role = Gerant::where('id_utilisateur', $user->id)->first();
            } elseif ($user->role === 'vendeur') {
                $role = Vendeur::where('id_utilisateur', $user->id)->first();
            } else {
                $role = null;
            }

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

        if ($request->role === 'gerant') {
            $role = Gerant::create([
                'id_utilisateur' => $user->id
            ]);
        } else {
            $role = null;
        }

        // Création du token
        $token = $user->createToken('API Token')->plainTextToken;

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
                'password' => 'required|string|min:8',
                'id_pharmacie' => 'required|exists:pharmacies,id_pharmacie',

            ]);

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'role' => 'vendeur',
            ]);
            $vendeur = Vendeur::create([
                'id_pharmacie' => $request->id_pharmacie,
                'id_utilisateur' => $user->id,
            ]);

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
     public function resetpassword(Request $request)
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
                'status' => 'required|string|max:255',
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

}
