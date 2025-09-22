<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Deces;
use App\Models\Mariage;
use App\Models\Naissance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDashbaord extends Controller
{
    public function dashboard()
    {
        // Récupérer les données de l'utilisateur connecté
        $user = Auth::user();
        
        // Compter les demandes par type
        $naissancesCount = Naissance::where('user_id', $user->id)->count();
        $decesCount = Deces::where('user_id', $user->id)->count();
        $mariagesCount = Mariage::where('user_id', $user->id)->count();
        $totalCount = $naissancesCount + $decesCount + $mariagesCount;
        
        // Compter les demandes par état
        $pendingCount = Naissance::where('user_id', $user->id)->where('etat', 'en attente')->count()
            + Deces::where('user_id', $user->id)->where('etat', 'en attente')->count()
            + Mariage::where('user_id', $user->id)->where('etat', 'en attente')->count();
            
        $receivedCount = Naissance::where('user_id', $user->id)->where('etat', 'réçu')->count()
            + Deces::where('user_id', $user->id)->where('etat', 'réçu')->count()
            + Mariage::where('user_id', $user->id)->where('etat', 'réçu')->count();
            
        $completedCount = Naissance::where('user_id', $user->id)->where('etat', 'terminé')->count()
            + Deces::where('user_id', $user->id)->where('etat', 'terminé')->count()
            + Mariage::where('user_id', $user->id)->where('etat', 'terminé')->count();
        
        // Récupérer les activités récentes (les 5 dernières demandes de chaque type)
        $recentNaissances = Naissance::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get()
            ->map(function($item) {
                return [
                    'type' => 'naissance',
                    'reference' => $item->reference,
                    'etat' => $item->etat,
                    'date' => $item->created_at->diffForHumans()
                ];
            });
            
        $recentDeces = Deces::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get()
            ->map(function($item) {
                return [
                    'type' => 'décès',
                    'reference' => $item->reference,
                    'etat' => $item->etat,
                    'date' => $item->created_at->diffForHumans()
                ];
            });
            
        $recentMariages = Mariage::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(2)
            ->get()
            ->map(function($item) {
                return [
                    'type' => 'mariage',
                    'reference' => $item->reference,
                    'etat' => $item->etat,
                    'date' => $item->created_at->diffForHumans()
                ];
            });
        
        // Fusionner et trier les activités récentes
        $recentActivities = $recentNaissances->concat($recentDeces)->concat($recentMariages)
            ->sortByDesc('date')
            ->take(2);

        return view('user.dashboard', compact(
            'naissancesCount',
            'decesCount',
            'mariagesCount',
            'totalCount',
            'pendingCount',
            'receivedCount',
            'completedCount',
            'recentActivities'
        ));
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login');
    }
}
