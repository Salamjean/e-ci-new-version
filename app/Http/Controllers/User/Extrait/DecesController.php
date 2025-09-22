<?php

namespace App\Http\Controllers\User\Extrait;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserExtraitDecesRequest;
use App\Models\Deces;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class DecesController extends Controller
{
    public function index()
    {
        // Récupérer l'user connecté
        $user = Auth::user();
        $deces = Deces::where('user_id', $user->id)->paginate(20);

        return view('user.extraits.deces.index', compact('deces'));
    }

    public function create()
    {
        return view('user.extraits.deces.create');
    }

    public function store(UserExtraitDecesRequest $request)
    {
        $imageBaseLink = '/images/deces/';

        // Liste des fichiers à traiter
        $filesToUpload = [
            'CNIdfnt' => 'cnid/',
            'CNIdcl' => 'cnid/', 
            'documentMariage' => 'mariage/',
            'RequisPolice' => 'police/', 
        ];

        $uploadedPaths = []; 

        foreach ($filesToUpload as $fileKey => $subDir) {
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                $extension = $file->getClientOriginalExtension();
                $newFileName = (string) Str::uuid() . '.' . $extension;

                // Stocker le fichier dans le bon sous-dossier
                $file->storeAs("public/images/deces/$subDir", $newFileName);

                // Ajouter le chemin public à $uploadedPaths
                $uploadedPaths[$fileKey] = $imageBaseLink . "$subDir" . $newFileName;
            }
        }

        // Vérifier si l'utilisateur est authentifié
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Vous devez être connecté pour effectuer cette action.');
        }

        // Récupérer l'utilisateur connecté
        $user = Auth::user();

        // Générer la référence ici dans le contrôleur
        $communeInitiale = strtoupper(substr($request->communeD ?: $user->commune ?: 'X', 0, 1)); // 'X' si commune est null ou vide (prend communeD du request si existe sinon commune user sinon X)
        $anneeCourante = Carbon::now()->year;
        $reference = 'AD' . str_pad(Deces::getNextId(), 4, '0', STR_PAD_LEFT) . $communeInitiale . $anneeCourante; // ADJ pour Acte de Decès Déjà Jugé


        // Enregistrement de l'objet deces
        $deces = new Deces();
        $deces->name = $request->name;
        $deces->numberR = $request->numberR;
        $deces->dateR = $request->dateR;
        $deces->CNIdfnt = $uploadedPaths['CNIdfnt'] ?? null;
        $deces->CNIdcl = $uploadedPaths['CNIdcl'] ?? null;
        $deces->documentMariage = $uploadedPaths['documentMariage'] ?? null;
        $deces->RequisPolice = $uploadedPaths['RequisPolice'] ?? null;
        $deces->choix_option = $request->choix_option;
        $deces->commune = $request->communeD ?: $user->commune; // Déterminer la commune
        $deces->etat = 'en attente';
        $deces->user_id = $user->id; // Lier la demande à l'utilisateur connecté
        $deces->reference = $reference; // Assignez la référence générée

           // Ajout des informations de livraison si option livraison est choisie
        if ($request->input('choix_option') === 'livraison') {
            $deces->montant_timbre = $request->input('montant_timbre');
            $deces->montant_livraison = $request->input('montant_livraison');
            $deces->nom_destinataire = $request->input('nom_destinataire');
            $deces->prenom_destinataire = $request->input('prenom_destinataire');
            $deces->email_destinataire = $request->input('email_destinataire');
            $deces->contact_destinataire = $request->input('contact_destinataire');
            $deces->adresse_livraison = $request->input('adresse_livraison');
            $deces->code_postal = $request->input('code_postal');
            $deces->ville = $request->input('ville');
            $deces->commune_livraison = $request->input('commune_livraison');
            $deces->quartier = $request->input('quartier');
        }

        $deces->save();

        return redirect()->route('user.extrait.death.index')->with('success', 'Demande envoyée avec succès.');
    }
    public function deletedeja(deces $deces)
    {
        try {
            $deces->delete();
            return redirect()->route('user.extrait.death.index')->with('success', 'La demande a été supprimée avec succès.');
        } catch (Exception $e) {
            // Log l'erreur pour le débogage
            Log::error('Erreur lors de la suppression de la demande : ' . $e->getMessage());
            return redirect()->route('user.extrait.death.index')->with('error', 'Une erreur est survenue lors de la suppression de la demande.');
        }
    }
}
