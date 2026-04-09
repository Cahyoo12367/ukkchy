<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userData = session('user_data');

        $menuNames = session('user_data.menus', []);
        $requestedMenu = 'User Management';

        // Jika menu yang diminta tidak ada dalam hak akses, redirect atau beri pesan error
        if (!in_array($requestedMenu, $menuNames)) {
            // Redirect jika tidak memiliki akses
            return redirect()->route('pageDashboard');
        }

        $menus = Menu::whereIn('name', $menuNames)
            ->orderBy('parent_id')
            ->orderBy('order')
            ->get()
            ->groupBy('parent_id');

        return view('users.index', compact('userData', 'menus'));
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
