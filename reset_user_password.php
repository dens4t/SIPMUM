<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

$user = User::where('email', 'user@pmum.my.id')->first();

if ($user) {
    $user->password = Hash::make('password');
    $user->save();
    echo "Password reset successfully for user@pmum.my.id\n";
    echo "New password hash: " . $user->password . "\n";
} else {
    echo "User not found.\n";
}
