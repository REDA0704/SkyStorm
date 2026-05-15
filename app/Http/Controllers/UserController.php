<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

/**
 * Contrôleur pour gérer les utilisateurs
 * Permet de lister, afficher et rechercher des utilisateurs
 */
class UserController extends Controller
{
    /**
     * Affiche la liste des utilisateurs avec une recherche optionnelle
     * Recherche les utilisateurs par nom
     *
     * @param Request $request La requête contenant le paramètre de recherche
     * @return \Illuminate\Contracts\Support\Renderable La vue users.index avec les utilisateurs
     */
    public function index(Request $request)
    {
        // Récupère le paramètre de recherche depuis la requête (URL)
        $search = $request->search;

        // Cherche les utilisateurs dont le nom contient le texte de recherche
        // Utilise LIKE pour une recherche partielle (insensible à la casse)
        $users = User::where('name', 'like', '%' . $search . '%')
            ->get();

        // Retourne la vue avec les utilisateurs trouvés
        return view('users.index', compact('users'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Affiche le profil détaillé d'un utilisateur spécifique
     * Affiche aussi les posts de cet utilisateur
     *
     * @param User $user L'utilisateur à afficher (injecté via model binding)
     * @return \Illuminate\Contracts\Support\Renderable La vue users.show avec l'utilisateur et ses posts
     */
    public function show(User $user)
    {
        // Récupère tous les posts de l'utilisateur, triés par ordre
        $posts = $user->posts()->latest()->get();

        // Retourne la vue avec l'utilisateur et ses posts
        return view('users.show', compact('user', 'posts'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
