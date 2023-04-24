<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    //
    function getlist($id=null){

        return $id?User::find($id):User::all();
    }
  
    public function Adduser(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|max:255',
        ]);

        $user = new User([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => Hash::make($request['password']),
        ]);

        $user->save();

        return response()->json([
            'message' => 'Utilisateur créé avec succès',
            'user' => $user
        ], 201);
    }

    public function update(Request $request)
{
    
   /* $this->validate($request, [
        'name' => 'string|max:255',
        'email' => 'string|email|unique:users|max:255',
        'password' => 'string|min:8|max:255',
    ]);*/
    $user = Auth::user();

    $user->name = $request->input('name');
    $user->email = $request->input('email');
    $user->password = Hash::make($request['password']);
    $user->save();

    return response()->json([
        'message' => 'Utilisateur mis à jour avec succès',  
    ], 200);
}

    public function deleteUser()
{
    $user = Auth::user();
    $user->delete();
    return response()->json(['message' => 'User deleted successfully']);
}

    public function login(Request $request)
    {
        $user= User::where('email', $request->email)->first();
        // print_r($data);
            if (!$user || !Hash::check($request->password, $user->password)) {
                return response([
                    'message' => ['These credentials do not match our records.']
                ], 404);
            }
        
             $token = $user->createToken('my-app-token')->accessToken;
        
            $response = [
                'user' => $user,
                'token' => $token
            ];
        
             return response($response, 201);
    }

    
    public function logout(Request $request)
{
    
   /* $user->tokens()->delete(); */
    Auth::logout();
    return response()->json(['message' => 'Logged out successfully']);
}


}



