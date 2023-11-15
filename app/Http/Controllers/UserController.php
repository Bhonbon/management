<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('admin', '=', 0)->orderBy('id', 'desc')->get();

        return view('users', compact('users'));
    }

    public function approve($user_id)
    {
        $user = User::findOrFail($user_id);
        
        if (!$user->approved_at) {
            $user->update(['approved_at' => now()]);
            $message = 'User approved successfully';
        } else {
            $user->update(['approved_at' => null]);
            $message = 'User disapproved successfully';
        }
    
        return redirect()->route('admin.users.index')->withMessage($message);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);
    
        $users = $request->all();
    
        // Set a default password or generate one as needed
        $defaultPassword = 'default_password'; // Change this to your desired default password
        $users['password'] = bcrypt($defaultPassword);
    
        User::create($users);

        return redirect()->route('users');
    } 
}
