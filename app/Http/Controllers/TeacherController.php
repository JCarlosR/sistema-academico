<?php

namespace App\Http\Controllers;

use App\SchoolYear;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class TeacherController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {

        return view('usuarios.docentes');
    }

    public function store(Request $request)
    {
        // by default the password is the identity_card
        // gender is an optional field

        $rules = [
            'email' => 'required|email|unique:users',
            'first_name' => 'required|min:4',
            'last_name' => 'required|min:4',
            'identity_card' => 'digits:8',
            'birth_date' => 'date',
            'photo' => 'image',
            'remark' => 'min:4',
            'phone' => 'min:6',
            'cellphone' => 'min:6',
            'address' => 'min:4'
        ];

        $messages = [
            'email.required' => 'Es necesario especificar una dirección de correo electrónico.',
            'email.email' => 'El campo e-mail no tiene el formato adecuado.',
            'email.unique' => 'El e-mail es único por cada usuario, ya que se usará para acceder al sistema.',
            'first_name.required' => 'Es necesario ingresar los nombres del usuario.',
            'first_name.min' => 'Ingrese un nombre adecuado.',
            'last_name.required' => 'Es necesario ingresar los apellidos del usuario.',
            'last_name.min' => 'Ingrese un apellido adecuado.',
            'identity_card.digits' => 'El DNI debe presentar 8 dígitos.',
            'birth_date' => 'Por favor ingrese una fecha de nacimiento adecuada.',
            'photo.image' => 'Asegúrese de subir una imagen adecuada para la foto.',
            'remark.min' => 'Ingrese adecuadamente las observaciones.',
            'phone.min' => 'Ingrese al menos 6 caracteres para el teléfono.',
            'cellphone.min' => 'Ingrese al menos 6 caracteres para el celular.',
            'address.min' => 'Ingrese al menos 4 caracteres para la dirección.'
        ];

        $v = Validator::make($request->all(), $rules, $messages);

        if ($v->fails())
            return back()->withErrors($v)->withInput();

        // here we add a custom validations

        $user = User::create([
            'email' => $request->get('email'),
            'password' => $request->get('identity_card'),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'identity_card' => $request->get('identity_card'),
            'gender' => $request->get('gender'),
            'birth_date' => $request->get('gender'),
            // 'photo' => $request->hasFile('photo'),
            'remark' => $request->get('remark'),
            'phone' => $request->get('phone'),
            'cellphone' => $request->get('cellphone'),
            'address' => $request->get('address'),
            'role_id' => 3 // Docente
        ]);

        if ($request->hasFile('photo'))
        {
            $archivo = $request->file('photo');

            // the file name is based on the user id
            $extension = $archivo->getClientOriginalExtension();
            $nombreArchivo = $user->id . "." . $extension;

            // save the image
            $archivo->move(public_path() . '/imagenes/docentes/', $nombreArchivo);

            // update the extension
            $user->photo = $extension;
            $user->save();
        }

        return back()->with('success', 'El docente se ha registrado exitosamente.');
    }

}
