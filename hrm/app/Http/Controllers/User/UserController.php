<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $rooms = Room::where('is_available', true)->get();
        return view('dashboard', compact('rooms'));
    }
}
