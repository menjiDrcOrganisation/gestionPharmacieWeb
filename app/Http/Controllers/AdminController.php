<?php

namespace App\Http\Controllers;

use App\Models\admin;

use App\Models\gerant;
use App\Models\Pharmacie;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }
    public function gerant()
    {

        $pharmacies = Pharmacie::with('gerant')
            ->with('gerant.user')
            ->get();

        $gerants = gerant::with('user')->
            get();


        return view('gerants.index', compact('pharmacies', 'gerants'));
    }
    public function redirectToGoogle()
    {

        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {

        try {


            // $googleUser = Socialite::driver('google')->stateless()->user();
            $googleUser = Socialite::driver('google')->stateless()->setHttpClient(
                new \GuzzleHttp\Client(['verify' => false])
            )->user();



            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName(),
                    'password' => bcrypt(uniqid()), // mot de passe aléatoire
                ]
            );

            Auth::login($user);

            return redirect('/dashboard'); // ou où tu veux rediriger
        } catch (\Exception $e) {
            return dd($e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function red(Request $request, $id)
    {
        $gerant = Gerant::findOrFail($id);

        // Mise à jour des infos utilisateur liées
        $gerant->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Mise à jour des pharmacies liées
        $gerant->pharmacies()->sync($request->pharmacies ?? []);

        return redirect()->back()->with('success', 'Gérant mis à jour avec succès ✅');
    }
    public function updategerant(Request $request, Gerant $gerant)
    {

        $gerant->user->update($request->only(['name', 'email']));

        // Réinitialiser les pharmacies du gérant
        // Pharmacie::where('id_gerant', $gerant->id_gerant)->update(['id_gerant' => null]);

        // // Réattribuer les pharmacies sélectionnées
        // if ($request->filled('pharmacies')) {
        //     Pharmacie::whereIn('id_pharmacie', $request->pharmacies)
        //         ->update(['id_gerant' => $gerant->id_gerant]);
        // }

        return redirect()->back()->with('success', 'Gérant mis à jour avec succès');
    }



    public function store(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt("opharma12345"),
        ]);

            $info = Gerant::Create([
                'id_utilisateur' => $user->id
            ]);


        return redirect()->back()->with('success', 'Gérant mis à jour avec succès');
    }

    /**
     * Display the specified resource.
     */
    public function show(admin $admin)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(admin $admin)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, admin $admin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(admin $admin)
    {
        //
    }
}
