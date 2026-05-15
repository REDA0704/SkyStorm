<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
 * Classe contrôleur de base
 * Hérite des fonctionnalités Laravel de base (validation, autorisation)
 */
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
