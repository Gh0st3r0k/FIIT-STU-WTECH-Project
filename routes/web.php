<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\BasketController;



Route::get('/', function () {
    return view('general.main_page.main');
});

Route::view('/login', 'auth.login.login');
Route::view('/admin/registration', 'auth.registration.admin-registration');
Route::view('/user/registration', 'auth.registration.user-registration');
Route::view('/error', 'error.error');
Route::view('/admin/basket', 'general.basket.admin-basket');
Route::view('/user/basket', 'general.basket.user-basket');
Route::view('/admin/catalog', 'general.catalog.admin-catalog');
Route::view('/user/catalog', 'general.catalog.user-catalog');
Route::view('/contact', 'general.contact.contact');
Route::view('/main-page', 'general.main_page.main');
Route::view('/admin/product-card', 'general.product_card.admin-product_card');
Route::view('/user/product-card', 'general.product_card.user-product_card');
Route::view('/admin/profile', 'general.profile.admin-profile');
Route::view('/user/profile', 'general.profile.user-profile');

Route::get('/logout', function () {
    session()->forget('user');
    session()->flush(); // полностью очистить сессию
    return redirect('/login');
})->name('logout');


Route::post('/register', function (Request $request) {
    // Получаем JSON-данные
    $data = $request->json()->all();

    // Валидация на всякий случай (можно добавить больше правил)
    if (
        empty($data['name']) ||
        empty($data['surname']) ||
        empty($data['email']) ||
        empty($data['password'])
    ) {
        return response()->json(['message' => 'All fields are required.'], 400);
    }

    $path = storage_path('app/users.json');

    // Загружаем текущих пользователей
    $users = file_exists($path) ? json_decode(file_get_contents($path), true) : [];

    // Проверяем, есть ли такой email
    foreach ($users as $user) {
        if ($user['email'] === $data['email']) {
            return response()->json(['message' => 'User already exists.'], 409);
        }
    }

    // Добавляем нового пользователя
    $users[] = [
        'name' => $data['name'],
        'surname' => $data['surname'],
        'email' => $data['email'],
        'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        'created_at' => now()->toDateTimeString()
    ];

    // Сохраняем
    file_put_contents($path, json_encode($users, JSON_PRETTY_PRINT));

    return response()->json(['message' => 'Registration successful.'], 200);
})->name('register.submit');




Route::post('/login', function (Request $request) {
    $data = $request->json()->all();

    if (empty($data['email']) || empty($data['password'])) {
        return response()->json(['message' => 'Email and password required.'], 400);
    }

    $path = storage_path('app/users.json');
    $users = file_exists($path) ? json_decode(file_get_contents($path), true) : [];

    foreach ($users as $user) {
        if ($user['email'] === $data['email']) {
            if (password_verify($data['password'], $user['password'])) {
                // Успешный вход
                Session::put('user', [
                    'name' => $user['name'],
                    'surname' => $user['surname'],
                    'email' => $user['email']
                ]);
                return response()->json(['message' => 'Login successful!']);
            } else {
                return response()->json(['message' => 'Incorrect password.'], 401);
            }
        }
    }

    return response()->json(['message' => 'User not found.'], 404);
});



Route::get('/user/product-card/{id}', function ($id) {
    $json = file_get_contents(public_path('data/products.json'));
    $products = json_decode($json, true);

    $product = collect($products)->firstWhere('id', (int) $id);

    if (!$product) {
        abort(404, 'Produkt neexistuje.');
    }

    return view('general.product_card.user-product_card', ['product' => $product]);
});


Route::post('/api/basket/add', [\App\Http\Controllers\BasketController::class, 'add']);
Route::get('/user/basket', [\App\Http\Controllers\BasketController::class, 'view']);




Route::fallback(function () {
    return redirect('/error');
});