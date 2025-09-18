<?php

namespace App\Http\Controllers;

use App\Models\admin;
use App\Models\gerant;
use App\Models\Medicament;
use App\Models\Pharmacie;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
 

public function dashboard()
{
    // Compteurs globaux
    $totalAdmins = gerant::count();
    $totalPharmacies = Pharmacie::count();
    $totalMedicaments = Medicament::count();

    // Médicaments ajoutés par mois
    $medicamentsParMois = Medicament::select(
            DB::raw('MONTH(created_at) as mois'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('mois')
        ->orderBy('mois')
        ->pluck('total', 'mois');

    // Pharmacies ajoutées par mois
    $pharmaciesParMois = Pharmacie::select(
            DB::raw('MONTH(created_at) as mois'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('mois')
        ->orderBy('mois')
        ->pluck('total', 'mois');

    // Admins ajoutés par mois
    $adminsParMois = Gerant::select(
            DB::raw('MONTH(created_at) as mois'),
            DB::raw('COUNT(*) as total')
        )
        ->groupBy('mois')
        ->orderBy('mois')
        ->pluck('total', 'mois');

    $moisNoms = [
        1 => 'Jan', 2 => 'Fév', 3 => 'Mar', 4 => 'Avr',
        5 => 'Mai', 6 => 'Juin', 7 => 'Juil', 8 => 'Août',
        9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Déc'
    ];

    // Formater les données par mois
    $medicamentsParMoisFormate = [];
    $pharmaciesParMoisFormate = [];
    $adminsParMoisFormate = [];

    foreach ($moisNoms as $num => $nom) {
        $medicamentsParMoisFormate[$nom] = $medicamentsParMois[$num] ?? 0;
        $pharmaciesParMoisFormate[$nom] = $pharmaciesParMois[$num] ?? 0;
        $adminsParMoisFormate[$nom] = $adminsParMois[$num] ?? 0;
    }

    return view('dashboard', compact(
        'totalAdmins',
        'totalPharmacies',
        'totalMedicaments',
        'medicamentsParMoisFormate',
        'pharmaciesParMoisFormate',
        'adminsParMoisFormate',
        'moisNoms'
    ));
}


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

       
        return redirect()->back()->with('success', 'Gérant mis à jour avec succès');
    }


        public function admin (){
            $admins = admin::with('user')->get();   
            return view('admins.index', compact('admins'));
        }
        public function storeadmin(Request $request)
    { 
        
        try {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt("opharma12345"),
            'role' => 'admin',
        ]);
          $info = admin::Create([
                'id_utilisateur' => $user->id
            ]);
          
        return redirect()->back()->with('success', 'Admin mis à jour avec succès');
    } catch (\Exception $e) {
        return dd($e->getMessage());
        return redirect()->back()->with('error', 'Erreur lors de la création de l\'admin');
    }
}
        public function updateadmin(Request $request, admin $admin)
    {   
        $admin->user->update($request->only(['name', 'email']));

        return redirect()->back()->with('success', 'Admin mis à jour avec succès');
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
