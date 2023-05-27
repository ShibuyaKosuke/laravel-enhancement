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
            // @todo Scope に移動予定
            ->when($request->company_id, function ($query, $company_id) {
                return $query->where('company_id', $company_id);
            })
            // @todo Scope に移動予定
            ->when($request->section_id, function ($query, $section_id) {
                return $query->whereHas('sections', function ($query) use ($section_id) {
                    $query->where('sections.id', $section_id);
                });
            })
            ->paginate()
            ->withQueryString();

        return view('users.index', compact('users'));
    }
}
