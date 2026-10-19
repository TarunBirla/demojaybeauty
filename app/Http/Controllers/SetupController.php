<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use PDO;

class SetupController extends Controller
{
    public function setup()
    {
        $messages = [];
        $error = null;

        try {
            $host = config('database.connections.mysql.host', '127.0.0.1');
            $port = config('database.connections.mysql.port', '3306');
            $database = config('database.connections.mysql.database', 'jaysbeauty');
            $username = config('database.connections.mysql.username', 'root');
            $password = config('database.connections.mysql.password', '');

            // 1. Check & create database if not exists
            try {
                $pdo = new PDO("mysql:host={$host};port={$port}", $username, $password);
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $pdo->exec("CREATE DATABASE IF NOT EXISTS `{$database}` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
                $messages[] = "✅ Database `{$database}` is ready (Created or already exists).";
            } catch (\Exception $e) {
                $messages[] = "⚠️ Note on database check: " . $e->getMessage();
            }

            // 2. Run migrations safely
            Artisan::call('migrate', ['--force' => true]);
            $migrationOutput = Artisan::output();
            $messages[] = "✅ Migrations executed safely without altering existing tables:";
            $messages[] = "<pre style='background:#f8f9fa; padding:10px; border-radius:5px; font-size:12px;'>" . e($migrationOutput) . "</pre>";

            // 3. Create default admin if not exists
            $adminEmail = 'admin@jaysbeauty.co.uk';
            $adminUser = User::where('email', $adminEmail)->first();

            if (!$adminUser) {
                User::create([
                    'name' => "Jay's Beauty Admin",
                    'email' => $adminEmail,
                    'password' => Hash::make('admin123'),
                    'role' => 'admin',
                ]);
                $messages[] = "✅ Default Admin Account created!";
            } else {
                $messages[] = "ℹ️ Admin account (`{$adminEmail}`) already exists.";
            }

            // 4. Verify tables
            $tables = DB::select('SHOW TABLES');
            $tableKey = 'Tables_in_' . $database;
            $tableList = array_map(function ($table) use ($tableKey) {
                return $table->$tableKey ?? reset($table);
            }, $tables);

            $messages[] = "✅ Existing active tables: <strong>" . implode(', ', $tableList) . "</strong>";

        } catch (\Exception $e) {
            $error = $e->getMessage();
        }

        return view('setup.index', compact('messages', 'error'));
    }
}
