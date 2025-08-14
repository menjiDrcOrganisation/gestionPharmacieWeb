<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gerant;
use App\Models\Pharmacie;
use App\Models\User;
use App\Models\Vendeur;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
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
    public function destroy(string $id)
    {
        //
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
