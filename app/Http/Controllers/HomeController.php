<?php


namespace App\Http\Controllers;


/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * @return false|string
     */
    public function home()
    {
        return file_get_contents(public_path('_nuxt/index.html'));
    }
}
