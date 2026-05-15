<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Contrôleur pour gérer les relations de suivi (follow/unfollow)
 * Permet aux utilisateurs de suivre et ne plus suivre d'autres utilisateurs
 */
class FollowController extends Controller
{
    public function follow(Request $request)
    {
        // Valide que following_id existe et est un entier valide
        $data = $request->validate([
            'following_id' => 'required|integer|exists:users,id',
        ]);

        // Vérifie que l'utilisateur ne suit pas déjà cette personne
        // Évite les doublons dans la relation
        if (!auth()->user()->following()->where('users.id', $data['following_id'])->exists()) {
            // Ajoute le suivi dans la table pivot (relation many-to-many)
            auth()->user()->following()->attach($data['following_id']);
        }

        // Redirige vers la page des utilisateurs
        return redirect()->route('users.index');
    }


    /**
     * Permet à l'utilisateur connecté d'arrêter de suivre un utilisateur
     * @param Request $request La requête HTTP contenant l'ID de l'utilisateur à ne plus suivre
     * @return RedirectResponse Redirige vers la liste des utilisateurs
     */
    public function unfollow(Request $request)
    {
        // Valide que following_id existe et est un entier valide
        $data = $request->validate([
            'following_id' => 'required|integer|exists:users,id',
        ]);

        // Supprime le suivi de la table pivot
        auth()->user()->following()->detach($data['following_id']);

        // Redirige vers la page des utilisateurs
        return redirect()->route('users.index');
    }


}
