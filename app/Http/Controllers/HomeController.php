<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Contrôleur pour la page d'accueil de l'application
 * Gère l'affichage du tableau de bord principal
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //l'utilisateur doit être connecté
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
