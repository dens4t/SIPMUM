# AGENTS.md - SIPMUM Development Guidelines

## Project Overview

This is a Laravel 10.x application with PHP 8.1+, using Filament 3.2 for the admin panel. The application manages employee data, vehicle requests, meeting consumption requests, and SPPD (official travel) submissions. The project follows Laravel conventions and uses PSR-4 autoloading with the `App\\` namespace.

## Build, Lint, and Test Commands

### PHP Commands (Composer)

```bash
# Install dependencies
composer install

# Run all tests
./vendor/bin/phpunit

# Run single test file
./vendor/bin/phpunit tests/Unit/ExampleTest.php

# Run single test method
./vendor/bin/phpunit --filter testMethodName

# Format code with Laravel Pint
./vendor/bin/pint

# Format specific file
./vendor/bin/pint app/Models/User.php

# Format with verbose output
./vendor/bin/pint -v

# Run Pint in dry-run mode (no changes)
./vendor/bin/pint --dry-run
```

### Frontend Commands (npm)

```bash
# Install frontend dependencies
npm install

# Start development server
npm run dev

# Build for production
npm run build

# Watch for changes during development
npm run dev
```

### Artisan Commands

```bash
# Clear all caches
php artisan optimize:clear

# Cache routes
php artisan route:cache

# Clear application cache
php artisan cache:clear

# Run database migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback

# Seed database
php artisan db:seed

# Run in maintenance mode
php artisan down

# Exit maintenance mode
php artisan up
```

## Code Style Guidelines

### General Formatting

- **Indentation:** 4 spaces (configured in `.editorconfig`)
- **Line endings:** LF (Unix-style)
- **Character encoding:** UTF-8
- **End of file:** Final newline required
- **Trailing whitespace:** Remove in PHP files

### PHP Coding Standards

Follow **PSR-12: Extended Coding Style** as enforced by Laravel Pint:

- Use `<?php` tag at the top of PHP files
- Declare strict types when appropriate
- Use parentheses for control structures even with single statements
- Place opening braces for classes/methods on the next line
- Use fully qualified class names or organize imports alphabetically

### Import Statements

Organize imports in the following order with one blank line between groups:

1. PHP core imports (`use` statements without aliases)
2. Composer package imports
3. Laravel framework imports
4. Application imports (`App\` namespace)

```php
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;

use App\Models\Pegawai;
```

### Naming Conventions

**Classes and Interfaces:**
- PascalCase for all class/interface names
- Suffix resources with meaningful names (e.g., `UserResource`, `PengajuanSPPDResource`)
- Suffix pages with `Page` or `Manage` prefix (e.g., `ManageUnits`, `ShowPegawai`)

**Variables and Properties:**
- camelCase for variables and properties
- Use descriptive names that indicate purpose
- Prefix boolean variables with `is`, `has`, `can`, or `should`

**Database Tables and Columns:**
- snake_case for table and column names
- Use plural for table names (e.g., `users`, `pengajuan_sppds`)
- Use foreign key pattern: `model_id` (e.g., `id_pegawai`, `id_kendaraan`)

**Methods:**
- camelCase for method names
- Use verb-noun pattern (e.g., `getData()`, `createUser()`)
- Controller methods should be descriptive (e.g., `datatable_pengajuan_sppd()`)

**Constants:**
- UPPER_SNAKE_CASE for constants
- Group related constants in classes or enums

### Type Declarations

- Use return type hints for all public methods
- Use property type hints where applicable
- Use strict typing in PHP 8.1+ files

```php
public function canAccessPanel(Panel $panel): bool
{
    return $this->is_admin;
}
```

### Error Handling

**Controller Error Handling:**
- Use `firstOrFail()` for model lookups that should return 404 if not found
- Use `abort(404)` for explicit not-found conditions
- Validate requests using Laravel's validation rules
- Return proper HTTP responses with error messages

```php
public function unit_get($unit)
{
    $unit = Unit::where('nama', $unit)->firstOrFail();
    if ($unit->page_unit == null) {
        return abort(404);
    }
    return view('guest.unit', compact('unit'));
}

public function login_proses(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ]);
}
```

**Exception Handling:**
- Register custom exceptions in `app/Exceptions/Handler.php`
- Use Laravel's built-in exception handling for validation errors
- Flash error messages to session for user feedback

### Filament-Specific Guidelines

- Follow Filament 3.2 patterns for resources, pages, and widgets
- Use Filament's built-in form and table components
- Organize resources under `app/Filament/Resources/`
- Organize pages under `app/Filament/Resources/{ResourceName}/Pages/`
- Organize relation managers under `app/Filament/Resources/{ResourceName}/RelationManagers/`

### Model Conventions

- Extend `Illuminate\Database\Eloquent\Model` or appropriate base class
- Define `$fillable` for mass-assignable attributes
- Define `$hidden` for attributes that should not be serialized
- Define `$casts` for attribute type conversion
- Define relationships using proper Laravel Eloquent methods

```php
class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'id_pegawai',
        'last_login_at',
        'is_admin',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'is_admin' => 'boolean',
    ];

    public function pegawai()
    {
        return $this->hasOne(Pegawai::class, 'id', 'id_pegawai');
    }
}
```

### Middleware Organization

- Place custom middleware in `app/Http/Middleware/`
- Use descriptive names indicating purpose (e.g., `ForceLogin`, `RedirectIfAdmin`)
- Register middleware aliases in `app/Http/Kernel.php`
- Use Laravel's built-in middleware for common operations

### Testing Guidelines

- Place unit tests in `tests/Unit/`
- Place feature tests in `tests/Feature/`
- Suffix all test classes with `Test` (e.g., `ExampleTest.php`)
- Extend `Tests\TestCase` base class
- Use descriptive test method names starting with `test_` or use PHPUnit's `test()` annotation

### Database and Migrations

- Use `snake_case` for column names
- Use foreign key constraints for relationships
- Prefix pivot table names with singular model names in alphabetical order (e.g., `role_user`)
- Include `id` as auto-increment primary key for all tables
- Use `timestamps()` for `created_at` and `updated_at` columns
- Use `softDeletes()` for soft delete functionality

### View and Blade Templates

- Store Blade templates in `resources/views/`
- Use descriptive directory names (e.g., `guest/`, `admin/`)
- Prefix admin views with resource name (e.g., `pegawai/index`)
- Use Laravel Blade directives for common operations
- Keep Blade logic minimal; push complex logic to controllers or View composers
