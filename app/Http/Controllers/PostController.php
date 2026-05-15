<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

/**
 * Contrôleur pour gérer les posts (articles/publications)
 * Affiche le fil d'actualité et les utilisateurs suggérés
 */
class PostController extends Controller
{
    /**
     * Affiche la liste des posts du fil d'actualité
     * Affiche les posts des utilisateurs suivis et de l'utilisateur connecté
     * Suggère aussi d'autres utilisateurs à suivre
     *
     * @return \Illuminate\Contracts\Support\Renderable La vue posts.index avec les posts et utilisateurs suggérés
     */
    public function index()
    {
        // Récupère les IDs des utilisateurs que l'utilisateur connecté suit
        $followingIds = auth()->user()->following->pluck('id');

        // Récupère les posts des utilisateurs suivis ET les posts de l'utilisateur lui-même
        // Les posts sont triés par ordre (plus récents en premier)
        $posts = Post::whereIn('user_id', $followingIds)
            ->orWhere('user_id', auth()->id())
            ->latest()
            ->get();

        // Suggère 5 utilisateurs que l'utilisateur ne suit pas encore
        // (excluant l'utilisateur connecté lui-même)
        $suggestedUsers = \App\Models\User::whereNotIn('id', auth()->user()->following->pluck('id'))
            ->where('id', '!=', auth()->id())
            ->take(5)
            ->get();

        // Retourne la vue avec les posts et utilisateurs suggérés
        return view('posts.index', compact('posts', 'suggestedUsers'));
    }

    /**
     * Affiche le formulaire de création d'un nouveau post
     *
     * @return \Illuminate\Contracts\Support\Renderable La vue posts.create avec le formulaire
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Enregistre un nouveau post en base de données
     * Crée un post avec le contenu fourni par l'utilisateur connecté
     *
     * @param Request $request La requête contenant le contenu du post
     * @return RedirectResponse Redirige vers la liste des posts
     */
    public function store(Request $request)
    {
        // Il faut valider le contenu du post
        $request->validate([
            'content' => 'required|min:1|max:280'
        ]);

        // Crée un nouveau post avec le contenu et l'ID de l'utilisateur connecté
        Post::create([
            'content' => $request->input('content'),
            'user_id' => auth()->id()
        ]);

        // Redirige vers la page des posts
        return redirect('/posts')->with('success', 'Post créé avec succès !');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Affiche le formulaire d'édition d'un post existant
     *
     * @param Post $post Le post à éditer (injecté via model binding)
     * @return \Illuminate\Contracts\Support\Renderable La vue posts.edit avec le post
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Met à jour le contenu d'un post en base de données
     *
     * @param Request $request La requête contenant le nouveau contenu
     * @param Post $post Le post à mettre à jour (injecté via model binding)
     * @return RedirectResponse Redirige vers la liste des posts
     */
    public function update(Request $request, Post $post)
    {
        //Vérifie que le post appartient à l'utilisateur
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        // Il faut valider le contenu du post
        $request->validate([
            'content' => 'required|min:1|max:280'
        ]);

        $post->update([
            'content' => $request->input('content')
        ]);

        return redirect('/posts');
    }

    /**
     * Supprime un post de la base de données
     *
     * @param Post $post Le post à supprimer (injecté via model binding)
     * @return RedirectResponse Redirige vers la liste des posts
     */
    public function destroy(Post $post)
    {
        //Vérifie que le post appartient à l'utilisateur
        if ($post->user_id !== auth()->id()) {
            abort(403);
        }

        $post->delete();
        return redirect('/posts')->with('success', 'Post supprimé !');
    }
}
