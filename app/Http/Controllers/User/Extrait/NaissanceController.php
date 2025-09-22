<?php

namespace App\Http\Controllers\User\Extrait;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserExtraitNaissanceRequest;
use App\Models\Naissance;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NaissanceController extends Controller
{
    public function index(){
        // Récupérer l'utilisateur connecté
        $user = Auth::user();
        $naissances = Naissance::where('user_id', $user->id)->paginate(20);
        return view('user.extraits.naissance.index', compact('naissances'));
        
    }

    public function create(){
        $userConnecté = Auth::user();
        return view('user.extraits.naissance.create', [
            'userName' => $userConnecté ? $userConnecté->name : '', 
            'userPrenom' => $userConnecté ? $userConnecté->prenom : '', 
            'userCommune' => $userConnecté ? $userConnecté->commune : '', 
            'userCMU' => $userConnecté ? $userConnecté->CMU : '', 
        ]);
    }

    public function store(UserExtraitNaissanceRequest $request)
    {
        // Log des données de la requête
        Log::info('Store method called', $request->all());

        // Configuration des chemins pour le stockage des fichiers
        $imageBaseLink = '/images/naissances/';
        $filesToUpload = [
            'CNI' => 'cni/',
        ];
        $uploadedPaths = [];

        // Traitement des fichiers uploadés
        foreach ($filesToUpload as $fileKey => $subDir) {
            if ($request->hasFile($fileKey)) {
                $file = $request->file($fileKey);
                $extension = $file->getClientOriginalExtension();
                $newFileName = (string) Str::uuid() . '.' . $extension;
                $file->storeAs("public/images/naissances/$subDir", $newFileName);
                $uploadedPaths[$fileKey] = $imageBaseLink . "$subDir" . $newFileName;
            }
        }

        // Récupération de l'utilisateur connecté
        $user = Auth::user();

        // Génération de la référence
        $communeInitiale = strtoupper(substr($user->commune ?? 'X', 0, 1)); // 'X' si commune est null ou vide
        $anneeCourante = Carbon::now()->year;
        $reference = 'AN' . str_pad(Naissance::getNextId(), 4, '0', STR_PAD_LEFT) . $communeInitiale . $anneeCourante;

        // Création de la demande d'extrait de naissance
        $naissance = new Naissance();
        $naissance->pour = $request->pour;
        $naissance->type = $request->type;
        $naissance->name = $request->name;
        $naissance->prenom = $request->prenom;
        $naissance->number = $request->number;
        $naissance->DateR = $request->DateR;
        $naissance->commune = $request->commune;
        $naissance->CNI = $uploadedPaths['CNI'] ?? null;
        $naissance->choix_option = $request->choix_option;
        $naissance->user_id = $user->id;
        $naissance->etat = 'en attente';
        $naissance->reference = $reference;
       

        // Ajout des informations de livraison si l'option "livraison" est choisie
        if ($request->input('choix_option') === 'livraison') {
            $naissance->montant_timbre = $request->input('montant_timbre');
            $naissance->montant_livraison = $request->input('montant_livraison');
            $naissance->nom_destinataire = $request->input('nom_destinataire');
            $naissance->prenom_destinataire = $request->input('prenom_destinataire');
            $naissance->email_destinataire = $request->input('email_destinataire');
            $naissance->contact_destinataire = $request->input('contact_destinataire');
            $naissance->adresse_livraison = $request->input('adresse_livraison');
            $naissance->code_postal = $request->input('code_postal');
            $naissance->ville = $request->input('ville');
            $naissance->commune_livraison = $request->input('commune_livraison');
            $naissance->quartier = $request->input('quartier');
        }

         $naissance->save();

        // Redirection avec un message de succès
        return redirect()->route('user.extrait.birth.index')->with('success', 'Votre demande a été traitée avec succès.');
    }
}
