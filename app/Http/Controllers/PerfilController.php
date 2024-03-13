<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {
        //Modificar el request
        $request->request->add(['username' => Str::slug($request->username)]);

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:3', 'max:20', 'not_in:twitter,editar-perfil']
            
        ]);

        if($request->imagen) {
            $image = $request->file('imagen');

            $imageName = Str::uuid() . "." . $image->extension();
    
            $serverImage = Image::make($image->getRealPath());
            $serverImage->fit(1000,1000);
    
            $imagePath = public_path('profiles') . '/' . $imageName;
            $serverImage->save($imagePath);
        }

        // guardar cambios
        $usuario = User::find(auth()->user()->id);
        $usuario->username = $request->username;
        $usuario->imagen = $imageName ?? auth()->user()->imagen ?? null;
        

        //cambiar la contraseña y email
        if($request->cambiar_datos) {
            $this->validate($request, [
                'email' => 'required|email|unique:users,imagen,'.auth()->user()->id,
                'password' => 'required|min:6',
                'new_password' => 'required|confirmed|min:6'
            ]);

            if(Hash::check($request->password, $usuario->password)) {
                $usuario->password = Hash::make($request->new_password);
                $usuario->email = $request->email ?? auth()->user()->email;
            } else {
                return redirect()->back()->withErrors(['password' => 'La contraseña actual es incorrecta']);
            }
        }

        $usuario->save();
        //Redireccionar
        return redirect()->route('posts.index', $usuario->username)->with('mensaje', 'Tu perfil se ha actualizado');
    }
}
