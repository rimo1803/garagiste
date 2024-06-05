<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Appointment;

class AppointmentController extends Controller
{
    public function showRequestForm()
    {
        $user = Auth::user();

        if ($user && $user->role === 'Client') {
            return view('client.request-appointment', ['client_id' => $user->id]);
        } else {
            return redirect()->route('home')->with('error', 'Seuls les clients peuvent demander un rendez-vous.');
        }
    }

    public function submitAppointment(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date',
            'appointment_time' => 'required',
            'vehicle_id' => 'required|exists:vehicles,id',
        ]);

        // Enregistrement de la demande de rendez-vous
        $appointment = new Appointment();
        $appointment->client_id = $request->input('client_id');
        $appointment->appointment_date = $request->input('appointment_date');
        $appointment->appointment_time = $request->input('appointment_time');
        $appointment->vehicle_id = $request->input('vehicle_id');
        $appointment->save();

        return redirect()->route('home')->with('success', 'Votre demande de rendez-vous a été soumise avec succès.');
    }
}
