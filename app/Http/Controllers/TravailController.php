<?php
namespace App\Http\Controllers;

use App\Models\Travail;
use Illuminate\Http\Request;

class TravailController extends Controller
{
    public function create()
    {
        // Liste des secteurs et des postes (prédéfinis ou récupérés d'une table)
        $secteurs = ['Informatique', 'Marketing', 'Finance']; // À ajuster selon vos besoins
        $postes = ['Développeur', 'Analyste', 'Consultant']; // À ajuster selon vos besoins

        return view('travail.create', compact('secteurs', 'postes'));
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'secteur' => 'required|string',
            'intitule' => 'required|string',
            'description' => 'nullable|string',
            'adresse' => 'required|string',
        ]);

        // Enregistrer le travail dans la base de données
        Travail::create($request->all());

        // Rediriger avec un message de succès
        return redirect()->route('travail.create')->with('success', 'Travail ajouté avec succès!');
    }
    public function devWeb()
    {
        // Récupérer toutes les annonces avec le poste "Développeur web"
        $annonces = Travail::where('intitule', 'Développeur web')->get();

        // Retourner la vue avec les annonces
        return view('informatique.developperweb', compact('annonces'));
    }
    public function pcGamer()
    {
        // Récupérer toutes les annonces avec le poste "Développeur web"
        $annonces = Travail::where('intitule', 'Vente de pc gamer')->get();

        // Retourner la vue avec les annonces
        return view('informatique.ventepcgamer', compact('annonces'));
    }
}
