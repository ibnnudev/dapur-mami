<?php

namespace App\Http\Controllers;

use App\Interfaces\CatalogManagementInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $menu;
    private $catalogMenu;
    public function __construct(CatalogManagementInterface $menu, CatalogManagementInterface $catalogMenu)
    {
        $this->menu = $menu;
        $this->catalogMenu = $catalogMenu;
    }

    public function index()
    {
        return view('user.index');
    }

    public function menu()
    {
        return view('user.menu', [
            'products' => $this->menu->getWithTotalSales()
        ]);
    }

    public function sortByPrice(Request $request)
    {
        $menus = $this->menu->sortByPrice($request->value);
        return view('user.component.list-menu', [
            'products' => $menus
        ])->render();
    }

    public function sortByCategory(Request $request)
    {
        $menus = $this->menu->sortByCategory($request->value);
        return view('user.component.list-menu', [
            'products' => $menus
        ])->render();
    }

    public function addCart($id)
    {
        $menu = $this->catalogMenu->find($id);
        return view('user.component.menu-item', [
            'menu' => $menu
        ])->render();
    }
}