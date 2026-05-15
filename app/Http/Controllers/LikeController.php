<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

/**
 * Contrôleur pour gérer les "likes" (j'aime) sur les posts
 * Permet de liker/disliker un post
 */
class LikeController extends Controller
{
    /**
     * Active ou désactive un like sur un post
     * Si l'utilisateur a déjà liké le post, le like est supprimé
     * Sinon, un nouveau like est créé
     *
     * @param Request $request La requête contenant l'ID du post
     * @return RedirectResponse Redirige vers la page précédente
     */
    public function toggle(Request $request)
    {
        // Récupère l'ID de l'utilisateur connecté
        $userId = auth()->id();

        // Récupère l'ID du post depuis la requête
        $postId = $request->post_id;

        // Cherche si l'utilisateur a déjà liké ce post
        $like = Like::where('user_id', $userId)
            ->where('post_id', $postId)
            ->first();

        // Si un like existe, le supprimer (contrairement)
        if ($like) {
            $like->delete();
            return redirect()->back();
        }

        // Sinon, créer un nouveau like
        Like::create([
            'user_id' => $userId,
            'post_id' => $postId
        ]);

        return redirect()->back();

    }

}
