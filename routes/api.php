<?php
//
//use App\Models\Color;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Route;
//
//Route::get('/colors', function (Request $request) {
//    $search = $request->query('search');
//    return Color::where('code', 'like', "%$search%")
//        ->orWhere('name', 'like', "%$search%")
//        ->take(10) // Limite à 10 résultats
//        ->pluck('code', 'id');
//});
