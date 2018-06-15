<?php
declare (strict_types = 1);

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * Class SpaController
 * @package App\Http\Controllers
 */
class SpaController extends Controller
{
    /**
     * @return View
     */
    public function index(): View
    {
        return view('welcome');
    }
}
