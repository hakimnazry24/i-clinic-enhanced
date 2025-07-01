# IIUM i-Clinic: Your Digital Healthcare Solution

## **TEAM MEMBERS**

1. MUHAMMAD HAKIM BIN MD NAZRI 2110457
2. AHMAD KAHLEEL 1927975
3. MUHAMMAD IQBAL AS SUFI BIN MAHAMAD A'SIM 2124165

# **INTRODUCTION**

The i-Clinic website is designed to facilitate healthcare delivery and offer a more convenient service to the students, staffs and patients. Previously, patients needed to walk in and often waited for long periods to receive treatment. Patients were also challenged to obtain timely information, such as about doctors' unavailability. Moreover, patient data was not recorded correctly since they had to do so through Google forms without a procedure to record the history of treatments for a subsequent use.This website aims to address these challenges. It consists of a clinically relevant, web-based scheduling and appointment which is accessible to patients for booking, rescheduling, and cancelling appointments. An effective medical record management system, which will secure access and update for patients as well as clinic staff. The website will have a billing and payment system in order to facilitate payment of bills easily, and it will ensure the timely information concerning the operations of clinic, hours of operation, and news. The aim of this project is to optimize clinic work processes as well as decrease waiting times and provide a more structured, reliable health service.

(**Khaleel**)
# **Authentication**

1- Password Hashing
We used Laravel's built-in system to securely hash all user passwords before storing them in the database. This ensures that even if the database is compromised, no one can read the real passwords.

2- User Role Assignment
Each user is automatically assigned a role (like patient) when they register. This role helps determine what pages or actions the user is allowed to access.

3- Secure Registration with Fortify
Instead of manually handling registration, we used Laravel Fortify, which provides secure and ready-to-use login, registration, and validation features.

4- Strong Password Validation
During registration, users must use strong passwords that meet security requirements (like minimum length, characters, etc.), helping to protect against easy-to-guess passwords.

5- Input Validation
We ensured that all user input during registration is properly validated, so only clean and correct data is saved into the system.

**Files/Code**
- app/Actions/Fortify/CreateNewUser.php
php
use Illuminate\Support\Facades\Hash;
...
return User::create([
    'name' => $input['name'],
    'email' => $input['email'],
    'password' => Hash::make($input['password']),
    'role' => 'patient',
]);


- database/migrations/xxxx_xx_xx_add_role_to_users_table.php
php
Schema::table('users', function (Blueprint $table) {
    $table->string('role')->default('patient');
});

- env File
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=strict

# **Authorization**

1- Custom Role Middleware
We created a custom middleware to check a user's role before allowing access to specific pages. For example, only an admin can access the admin dashboard.

2- Route Protection by Role
Certain routes (like admin or doctor pages) are protected using this middleware, so only users with the correct role can view them. Others will get a "403 Forbidden" error.

3- Middleware Registration
We registered the custom middleware in the Laravel system so it can be used across any route in the application.

4- Tested Role Access
We tested the system by logging in as different roles (admin, doctor, patient) to confirm that each role can only access its allowed pages.

**Files/Code**
- app/Http/Middleware/RoleMiddleware.php
php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, $role)
    {
        if (!Auth::check() || Auth::user()->role !== $role) {
            abort(403, 'Unauthorized access.');
        }

        return $next($request);
    }
}
- app/Http/Kernel.php
Edit
protected $routeMiddleware = [
    ...
    'role' => \App\Http\Middleware\RoleMiddleware::class
];


- routes/web.php
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    });
});

Route::middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/doctor/dashboard', function () {
        return view('doctor.dashboard');
    });
});



(IQBAL)
##  Database Security
1. **Replaced Root with Limited DB User**
   - Created a new MySQL user `admin` with limited permissions.
   - Avoids using the default `root` user for security reasons.

2. **Limited Database Privileges**
   - The `admin` user only has:
     - `SELECT`
     - `INSERT`
     - `UPDATE`
     - `DELETE`
   - Prevents access to commands like `DROP`, `GRANT`, or `ALTER`.

3. **Updated `.env` Credentials**
    DB_USERNAME=admin
    DB_PASSWORD=securepassword123
   - Ensures secure, non-root credentials are used in production.
   - Code:
   - DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=i-clinic
     DB_USERNAME=admin
     DB_PASSWORD=securepassword123

     
4. **SQL Injection Protection**
- All database interactions use **Eloquent ORM** or **Laravel Query Builder**, which automatically uses prepared statements.
- $user = User::where('email', $request->email)->first();


##  File Security

1. **Secure File Storage Location**
- Uploaded files are stored in `storage/app/secure_uploads`, which is **not publicly accessible** via URL.
- Code: MedicalRecordController.php
- $file->storeAs('secure_uploads', $fileName);


2. **Upload Validation**
- Ensures only valid file types and sizes are accepted:
  - MIME types: `jpeg`, `jpg`, `png`, `gif`, `pdf`
  - Maximum size: `2MB`
  - Code: MedicalRecordController.php store() and update():
  - $request->validate([
    'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
]);

3. **Filename Obfuscation**
- Uploaded files are renamed using UUID to prevent guessing or overwriting:
-Code: MedicalRecordController.php store() and update():
-$fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
  

4. **Controlled Access for Downloads**
- Files are only accessible via a Laravel controller method (`download()`), not through a direct URL.
- Code: MedicalRecordController.php download():
- public function download($filename)
{
    $path = storage_path('app/secure_uploads/' . $filename);
    if (!file_exists($path)) abort(404);
    return response()->download($path);
}
 

---
