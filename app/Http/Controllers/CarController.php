<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function getAvailableCars(Request $request)
    {
        $user = Auth::user();

        $startTime = $request->query('start_time');
        $endTime = $request->query('end_time');

        $availableCars = Car::whereHas('model.comfortCategory', function ($query) use ($user) {
            $query->whereIn('id', $user->position->comfortCategories->pluck('id'));
        })->whereDoesntHave('bookings', function ($query) use ($startTime, $endTime) {
            $query->where(function ($q) use ($startTime, $endTime) {
                $q->whereBetween('start_time', [$startTime, $endTime])
                    ->orWhereBetween('end_time', [$startTime, $endTime]);
            });
        });

        // фильтруем по модел
        if ($request->has('model')) {
            $availableCars->whereHas('model', function ($query) use ($request) {
                $query->where('name', $request->query('model'));
            });
        }

        return response()->json($availableCars->get());
    }
}
