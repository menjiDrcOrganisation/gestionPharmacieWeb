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
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
 

public function dashboard()
{
    // Totaux
    $totalAdmins = Gerant::count();
    $totalPharmacies = Pharmacie::count();

    // Derniers 7 gérants
    $gerants = Gerant::with('user', 'pharmacies')
        ->latest()
        ->take(7)
        ->get();

    // Dernières 7 pharmacies
    $pharmacies = Pharmacie::with('gerant.user')
        ->latest()
        ->take(7)
        ->get();

    // Nouveaux pharmacies (créées dans les 14 derniers jours)
    $nouveauxPharmacies = Pharmacie::where('created_at', '>=', now()->subDays(14))->count();

    // Gérants inactifs (aucune activité depuis 30 jours)
    $inactiveGerants = Gerant::where('updated_at', '<', now()->subDays(30))->count();

    // Variation (%) sur 30 jours
    $adminsLast30 = Gerant::where('created_at', '>=', now()->subDays(30))->count();
    $pharmaciesLast30 = Pharmacie::where('created_at', '>=', now()->subDays(30))->count();

    $adminsPrev30 = Gerant::whereBetween('created_at', [now()->subDays(60), now()->subDays(30)])->count();
    $pharmaciesPrev30 = Pharmacie::whereBetween('created_at', [now()->subDays(60), now()->subDays(30)])->count();

    $adminsVariation = $adminsPrev30 > 0 
        ? (($adminsLast30 - $adminsPrev30) / $adminsPrev30) * 100 
        : 100;

    $pharmaciesVariation = $pharmaciesPrev30 > 0 
        ? (($pharmaciesLast30 - $pharmaciesPrev30) / $pharmaciesPrev30) * 100 
        : 100;



     // --- PÉRIODE MOIS : derniers 12 mois (chronologique, oldest -> newest)
     $startMonth = Carbon::now()->startOfMonth()->subMonths(11);

     $medicamentsParMoisRaw = Medicament::where('created_at', '>=', $startMonth)
         ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as ym"), DB::raw('COUNT(*) as total'))
         ->groupBy('ym')->orderBy('ym')
         ->pluck('total','ym');
 
     $pharmaciesParMoisRaw = Pharmacie::where('created_at', '>=', $startMonth)
         ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as ym"), DB::raw('COUNT(*) as total'))
         ->groupBy('ym')->orderBy('ym')
         ->pluck('total','ym');
 
     $adminsParMoisRaw = Gerant::where('created_at', '>=', $startMonth)
         ->select(DB::raw("DATE_FORMAT(created_at, '%Y-%m') as ym"), DB::raw('COUNT(*) as total'))
         ->groupBy('ym')->orderBy('ym')
         ->pluck('total','ym');
 
     $moisNoms = [
         1 => 'Jan', 2 => 'Fév', 3 => 'Mar', 4 => 'Avr',
         5 => 'Mai', 6 => 'Juin', 7 => 'Juil', 8 => 'Août',
         9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Déc'
     ];
 
     $monthsLabels = [];
     $medicamentsParMoisFormate = [];
     $pharmaciesParMoisFormate = [];
     $adminsParMoisFormate = [];
 
     for ($i = 0; $i < 12; $i++) {
         $date = $startMonth->copy()->addMonths($i);          // oldest -> newest
         $ym = $date->format('Y-m');
         $monthNum = intval($date->format('n'));
         $label = $moisNoms[$monthNum];                      // affiche 'Jan','Fév',...
         $monthsLabels[] = $label;
         $medicamentsParMoisFormate[] = $medicamentsParMoisRaw[$ym] ?? 0;
         $pharmaciesParMoisFormate[] = $pharmaciesParMoisRaw[$ym] ?? 0;
         $adminsParMoisFormate[] = $adminsParMoisRaw[$ym] ?? 0;
     }
 
     // --- PÉRIODE JOURS : derniers 30 jours (chronologique)
     $startDay = Carbon::now()->startOfDay()->subDays(29);
 
     $medicamentsParJoursRaw = Medicament::where('created_at', '>=', $startDay)
         ->select(DB::raw("DATE(created_at) as day"), DB::raw('COUNT(*) as total'))
         ->groupBy('day')->orderBy('day')
         ->pluck('total','day');
 
     $pharmaciesParJoursRaw = Pharmacie::where('created_at', '>=', $startDay)
         ->select(DB::raw("DATE(created_at) as day"), DB::raw('COUNT(*) as total'))
         ->groupBy('day')->orderBy('day')
         ->pluck('total','day');
 
     $adminsParJoursRaw = Gerant::where('created_at', '>=', $startDay)
         ->select(DB::raw("DATE(created_at) as day"), DB::raw('COUNT(*) as total'))
         ->groupBy('day')->orderBy('day')
         ->pluck('total','day');
 
     $joursLabels = [];
     $medicamentsParJoursFormate = [];
     $pharmaciesParJoursFormate = [];
     $adminsParJoursFormate = [];
 
     for ($i = 0; $i < 30; $i++) {
         $date = $startDay->copy()->addDays($i);
         $key = $date->format('Y-m-d');
         $joursLabels[] = intval($date->format('d')); // affiche le numéro du jour (1..31)
         $medicamentsParJoursFormate[] = $medicamentsParJoursRaw[$key] ?? 0;
         $pharmaciesParJoursFormate[] = $pharmaciesParJoursRaw[$key] ?? 0;
         $adminsParJoursFormate[] = $adminsParJoursRaw[$key] ?? 0;
     }
 

    return view('dashboard', compact(
        'totalAdmins',
        'totalPharmacies',
        'nouveauxPharmacies',
        'inactiveGerants',
        'adminsVariation',
        'pharmaciesVariation',
        'gerants', 
        'pharmacies',
        'monthsLabels',
        'medicamentsParMoisFormate',
        'pharmaciesParMoisFormate',
        'adminsParMoisFormate',
        'joursLabels',
        'medicamentsParJoursFormate',
        'pharmaciesParJoursFormate',
        'adminsParJoursFormate'

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
