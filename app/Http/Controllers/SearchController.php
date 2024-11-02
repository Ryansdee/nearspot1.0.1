<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('search'); // Requête utilisateur (par exemple, "développeur web")
        
        // Fonction pour remplacer les caractères accentués
        $slug = $this->slugify($query);

        // Obtenir toutes les routes enregistrées
        $routes = collect(Route::getRoutes())->map(function ($route) {
            return $route->uri;
        });

        // Chercher les routes qui contiennent le slug
        $matchedRoute = $routes->first(function ($route) use ($slug) {
            return str_contains($route, $slug);
        });

        // Si une route correspond, on redirige vers cette route
        if ($matchedRoute) {
            return redirect('/' . $matchedRoute);
        }

        // Sinon, on renvoie un message d'erreur ou redirige vers une page 404
        return redirect()->back()->with('error', 'Aucune correspondance trouvée pour "' . $query . '"');
    }

    private function slugify($string)
    {
        // Remplacement des caractères accentués par leurs équivalents
        $replacements = [
            'é' => 'e',
            'è' => 'e',
            'ê' => 'e',
            'ë' => 'e',
            'à' => 'a',
            'â' => 'a',
            'ä' => 'a',
            'ô' => 'o',
            'ö' => 'o',
            'ù' => 'u',
            'û' => 'u',
            'ç' => 'c',
            ' ' => '-', // Remplacer les espaces par des tirets
            // Ajoutez d'autres remplacements si nécessaire
        ];

        // Remplacement dans la chaîne
        $string = strtr($string, $replacements);

        // Retirer tous les caractères non alphanumériques sauf les tirets
        $string = preg_replace('/[^a-z0-9-]/', '', strtolower(trim($string)));

        return $string;
    }
}
