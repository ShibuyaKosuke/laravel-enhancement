<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = User::query()
            ->with(['company', 'sections'])
            ->whereCompany($request)
            ->whereSection($request)
            ->paginate()
            ->withQueryString();

        return view('users.index', compact('users'));
    }
}
