<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestEmail;

class TestController extends Controller
{
    /**
     * Enviar un correo de prueba.
     *
     * @return \Illuminate\Http\Response
     */
    public function sendTestEmail()
    {
        // Enviar el correo de prueba usando la clase TestEmail
        Mail::to('test@example.com')->send(new TestEmail());

        return response()->json(['message' => 'Correo de prueba enviado.']);
    }
}
