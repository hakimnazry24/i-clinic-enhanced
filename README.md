# IIUM i-Clinic: Your Digital Healthcare Solution

## **TEAM MEMBERS**
1. Muhammad Hakim Bin Md Nazri 2110457
2. Ahmad Kahleel 1927975
3. Muhammad Iqbal As Sufi bin Mahamad A'sim 2124165
4. Muhammad Fadly 2117999


# **INTRODUCTION**

The i-Clinic website is designed to facilitate healthcare delivery and offer a more convenient service to the students, staffs and patients. Previously, patients needed to walk in and often waited for long periods to receive treatment. Patients were also challenged to obtain timely information, such as about doctors' unavailability. Moreover, patient data was not recorded correctly since they had to do so through Google forms without a procedure to record the history of treatments for a subsequent use.This website aims to address these challenges. It consists of a clinically relevant, web-based scheduling and appointment which is accessible to patients for booking, rescheduling, and cancelling appointments. An effective medical record management system, which will secure access and update for patients as well as clinic staff. The website will have a billing and payment system in order to facilitate payment of bills easily, and it will ensure the timely information concerning the operations of clinic, hours of operation, and news. The aim of this project is to optimize clinic work processes as well as decrease waiting times and provide a more structured, reliable health service.

# **Vulnerability Report - Muhammad Hakim (2110457)**
**Tool Used:** OWASP ZAP  
**Date of Scan:** 2025-07-01  
**Scanned By:** [Muhammad Hakim Bin Md Nazri]  
**Target Application:** http://localhost:8000.
**Scan Type:** Active   
**Scan Duration:** 5 minutes  

---

## 1. Executive Summary

| Metric                          | Value                                     |
|--------------------------------|-------------------------------------------|
| Total Issues Identified        | 23                                        |
| Critical Issues                | 0                                        |
| High-Risk Issues               | 1                                         |
| Medium-Risk Issues             | 22                                         |
| Low-Risk/Informational Issues |  0                                        |
| Remediation Status             | Pending                                   |
| Key Takeaway                   | The scan found no critical or high-risk issues. However, 1 high-risk issue and 22 medium-risk|

---

## 2. Summary of Findings

| Risk Level | Number of Issues | Example Vulnerability                    |
|------------|------------------|------------------------------------------|
| Critical   | 0                | -                                        |
| High       | 1                | SQL injection                                        |
| Medium     | 22                | Content Security Policy (CSP) header not set, missing Anti-clickjacking header |
| Low        | 0                |                                          |
| Info       | 0                | -                                        |

---
## 3. Detailed Findings

### SQL Injection

- **Severity:** High

- **Description:** SQL Injection is a security vulnerability that allows an attacker to interfere with the queries an application makes to its database. It happens when untrusted input is inserted into a SQL query without proper validation or escaping, allowing attackers to view, modify, or delete data they shouldn't have access to.

- **Affected URLs:**
  - http://localhost:8000/login

- **Business Impact:**
  - Data Breach – Unauthorized access to sensitive customer or company data.
  - Financial Loss – Potential theft, fraud, and cost of remediation.

- **OWASP Reference:** [https://owasp.org/www-community/attacks/SQL_Injection](https://owasp.org/www-community/attacks/SQL_Injection)

- **Recommendation:** To prevent SQL injection, use prepared statements, ORM frameworks, sanitize and validate inputs, apply the least privilege principle, use web application firewalls, perform regular security testing, and keep software up to date.

- **Prevention Strategy:**
  - Use prepared statements (parameterized queries)
  - Employ ORM frameworks to handle database operations safely
  - Sanitize and validate all user inputs
  - Enforce the principle of least privilege for database access
  - Implement web application firewalls (WAFs)
  - Conduct regular security testing and code reviews
  - Keep all software and dependencies up to date

> **Responsible Team:** Development team, database administrator  
> **Target Remediation Date:** 15 July 2025

---

### Content Security Policy (CSP) Header Not Set

- **Severity:** Medium

- **Description:** Content Security Policy (CSP) is an added layer of security that helps to detect and mitigate certain types of attacks, including Cross Site Scripting (XSS) and data injection attacks. These attacks are used for everything from data theft to site defacement or distribution of malware. CSP provides a set of standard HTTP headers that allow website owners to declare approved sources of content that browsers should be allowed to load on that page — covered types are JavaScript, CSS, HTML frames, fonts, images and embeddable objects such as Java applets, ActiveX, audio and video files.

- **Affected URLs:**
  - http://localhost:8000
  - http://localhost:8000/
  - http://localhost:8000/appointment
  - http://localhost:8000/appointment/assets/img/logo.png
  - http://localhost:8000/appointment/create
  - http://localhost:8000/appointment/index.html
  - http://localhost:8000/feedback
  - http://localhost:8000/forgot-password
  - http://localhost:8000/index.html
  - http://localhost:8000/login
  - http://localhost:8000/news
  - http://localhost:8000/news-form
  - http://localhost:8000/sitemap.xml

- **Business Impact:**
  - Increased Risk of XSS Attacks – Allows attackers to inject malicious scripts into your website
  - Data Theft – Sensitive customer or business data can be stolen through malicious scripts

- **OWASP Reference:** [https://owasp.org/www-community/controls/Content_Security_Policy](https://owasp.org/www-community/controls/Content_Security_Policy)

- **Recommendation:** To mitigate risks from missing CSP headers, define a strong Content-Security-Policy that restricts resource loading to trusted sources, avoid unsafe directives, test in report-only mode, and continuously monitor and update the policy.

- **Prevention Strategy:**
  - Set the Content-Security-Policy HTTP header in server responses
  - Allow only trusted domains for scripts, styles, images, and other resources
  - Avoid using unsafe-inline and unsafe-eval in the policy
  - Use nonces or hashes for inline scripts when necessary
  - Test CSP in Content-Security-Policy-Report-Only mode before enforcing
  - Monitor CSP violation reports to detect potential threats
  - Regularly review and update the policy as your application changes

> **Responsible Team:** Development team  
> **Target Remediation Date:** 30 July 2025

---

### Missing Anti-clickjacking Header

- **Severity:** Medium

- **Description:** The response does not protect against 'ClickJacking' attacks. It should include either Content-Security-Policy with 'frame-ancestors' directive or X-Frame-Options.

- **Affected URLs:**
  - http://localhost:8000
  - http://localhost:8000/
  - http://localhost:8000/appointment
  - http://localhost:8000/appointment/create
  - http://localhost:8000/feedback
  - http://localhost:8000/forgot-password
  - http://localhost:8000/login
  - http://localhost:8000/news
  - http://localhost:8000/news-form

- **Business Impact:**
  - Clickjacking Attacks – Users can be tricked into clicking hidden buttons or links
  - Unauthorized Actions – Attackers may perform unintended actions on behalf of users
  - Loss of User Trust – Compromised UI can reduce user confidence in your platform

- **OWASP Reference:** [https://owasp.org/www-community/attacks/Clickjacking](https://owasp.org/www-community/attacks/Clickjacking)

- **Recommendation:** Set the X-Frame-Options or Content-Security-Policy: frame-ancestors header to restrict your site from being embedded in iframes by unauthorized domains.

- **Prevention Strategy:**
  - Set the X-Frame-Options header to DENY or SAMEORIGIN
  - Use the Content-Security-Policy header with the frame-ancestors directive
  - Avoid embedding sensitive pages in iframes
  - Regularly audit and test iframe usage across your application
  - Educate developers on clickjacking risks and secure header implementation
  - Monitor security headers using automated tools or browser extensions

> **Responsible Team:** Development team  
> **Target Remediation Date:** 30 July 2025

---

### Missing Anti-clickjacking Header

- **Severity:** Medium

- **Description:** The response does not protect against 'ClickJacking' attacks. It should include either Content-Security-Policy with 'frame-ancestors' directive or X-Frame-Options.

- **Affected URLs:**
  - http://localhost:8000
  - http://localhost:8000/
  - http://localhost:8000/appointment
  - http://localhost:8000/appointment/create
  - http://localhost:8000/feedback
  - http://localhost:8000/forgot-password
  - http://localhost:8000/login
  - http://localhost:8000/news
  - http://localhost:8000/news-form

- **Business Impact:**
  - Clickjacking Attacks – Users can be tricked into clicking hidden buttons or links
  - Unauthorized Actions – Attackers may perform unintended actions on behalf of users
  - Loss of User Trust – Compromised UI can reduce user confidence in your platform

- **OWASP Reference:** [https://owasp.org/www-community/attacks/Clickjacking](https://owasp.org/www-community/attacks/Clickjacking)

- **Recommendation:** Set the X-Frame-Options or Content-Security-Policy: frame-ancestors header to restrict your site from being embedded in iframes by unauthorized domains.

- **Prevention Strategy:**
  - Set the X-Frame-Options header to DENY or SAMEORIGIN
  - Use the Content-Security-Policy header with the frame-ancestors directive
  - Avoid embedding sensitive pages in iframes
  - Regularly audit and test iframe usage across your application
  - Educate developers on clickjacking risks and secure header implementation
  - Monitor security headers using automated tools or browser extensions

> **Responsible Team:** Development team  
> **Target Remediation Date:** 30 July 2025

---

# Logging - Muhammad Hakim (2110457)
Logging was implemented in the i-Clinic web application by using Log facade. The purpose of logging is to monitor system activities and to record anomalies that happen within the system. For example, in the case of unsuccessful appointment booking, logging can help to record error stacks and specify the problem that causes it. Two types of logging was implemented in the application, error logging and info logging. Error logging is used to record error that happen within the system such as failed transaction, unsuccessful form submission and failed request. Info logging is used to record successful operation within the system such as successful transaction, successful databaes manipulation and many more. All log messages are recorded in _storage/logs/laravel.log_. The code below shows implementation of error and info logging.

Error logging
```php
use Illuminate\Support\Facades\Log;

try {
    // operations
} catch (\Exception $e) {
    Log::error("Failed to update user, ["user_id" => $id, "request_data" => $request->all()]);
}
```

Info logging
```php
use Illuminate\Support\Facades\Log;

try {
    // operations
} catch (\Exception $e) {
    Log::info("Update user successful, ["user_id" => $id, "request_data" => $request->all()]);
}
```

(**Khaleel**)
# **Authentication - Ahmad Kahleel (1927975)**

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
```php
use Illuminate\Support\Facades\Hash;

return User::create([
    'name' => $input['name'],
    'email' => $input['email'],
    'password' => Hash::make($input['password']),
    'role' => 'patient',
]);
```


- database/migrations/xxxx_xx_xx_add_role_to_users_table.php
```php
Schema::table('users', function (Blueprint $table) {
    $table->string('role')->default('patient');
});
```
- env File
```php
SESSION_SECURE_COOKIE=true
SESSION_HTTP_ONLY=true
SESSION_SAME_SITE=strict
```

# **Authorization - Ahmad Kahleel (1927975)**

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
```php
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
```

- app/Http/Kernel.php
```php
protected $routeMiddleware = [
    ...
    'role' => \App\Http\Middleware\RoleMiddleware::class
];
```


- routes/web.php
```php
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
```
#Database Security - Muhammad Iqbal As Sufi bin Mahamad A'sim 2124165

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
   -Code in .env:
   -DB_USERNAME=admin_user
   -DB_PASSWORD=admin123
   - Ensures secure, non-root credentials are used in production.
   
4. **SQL Injection Protection**
- All database interactions use **Eloquent ORM** or **Laravel Query Builder**, which automatically uses prepared statements.
- $user = User::where('email', $request->email)->first();


---

## File Security

1. **Secure File Storage Location**
- Uploaded files are stored in `storage/app/secure_uploads`, which is **not publicly accessible** via URL.
- Code: MedicalRecordController.php
- $file->storeAs('secure_uploads', $fileName);


2. **Upload Validation**
- Ensures only valid file types and sizes are accepted:
  - MIME types: `jpeg`, `jpg`, `png`, `gif`, `pdf`
  - Maximum size: `2MB`
  - Code: MedicalRecordController.php in store() and Update():
  - $request->validate([
    'image' => 'nullable|file|mimes: jpeg,png, jpg, gif,pdf|max:2048',
]);


3. **Filename Obfuscation**
- Uploaded files are renamed using UUID to prevent guessing or overwriting:
-Code: MedicalRecordController.php in store() and Update():
-$fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
  
4. **Controlled Access for Downloads**
- Files are only accessible via a Laravel controller method (`download()`), not through direct URL.
- Code: MedicalRecordController.php in download():
- public function download($filename)
{
    $path = storage_path('app/secure_uploads/' . $filename);

    if (!file_exists($path)) {
        abort(404);
    }

    return response()->download($path);
}


---



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

### Fadly ###
## Input Validation

1. Adding Regex to validate late
```php   
public function rules(): array
    {
        return [
            'name'       => 'required|string|max:255',
            'matric_id'  => ['required', 'regex:/^[0-9]+$/', 'max:50'],
            'email'      => 'required|email|max:255',
            'phone_no'   => ['required', 'regex:/^[0-9]+$/', 'max:20'],
            'date'       => 'required|date|after_or_equal:today',
            'department' => 'required|string|max:100',
            'doctor'     => 'required|string|max:255',
            'message'    => 'nullable|string|max:1000',
        ];
    }`
```


## XSS and CSRF Prevention

1. Using Purifier to add StripTags and making the output more cleaner
   ```php
   class StripTags
   {
    /**
     * Handle an incoming request and strip all HTML tags from input.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Grab all input data
        $input = $request->all();
        // Recursively strip tags from every value
        array_walk_recursive($input, function (&$value) {
            if (is_string($value)) {
                $value = strip_tags($value);
            }
        });
        // Merge sanitized data back into the request
        $request->merge($input);
        // Continue handling request
        return $next($request);
    }
   }
   ```
   
2. Adding Purifier to `AppointmentController.php`
   ```php
   public function store(AppointmentRequest $request)

    {
        try {
            // Only validated data is returned here
            $data = $request->validated();

            // sanitize the message field to prevent XSS
            $data['message'] = Purifier::clean($data['message'] ?? '');

            // mass-assign (Appointment::$fillable must include these fields)
            Appointment::create($data);

            Log::info('Successfully created appointment', ['data' => $data]);

            return redirect()
                   ->route('appointment.index')
                   ->with('success', 'Successfully created appointment');
        } catch (\Exception $e) {
            Log::error('Failed to create appointment', [
                'error' => $e->getMessage(),
                'data'  => $request->all(),
            ]);

            return redirect()
                   ->route('appointment.index')
                   ->with('error', 'Failed to create appointment');
        }
    }

   ```

3. Adding CSRF Token
   ```blade
   <form action="{{ route('appointment.store') }}" method="post" role="form">
            @csrf
   ```

4. Adding {{ }} to neutralizing any <script) tags
   ```blade
   {{-- Appointment List (escaped) --}}
          @if(isset($appointments) && $appointments->isNotEmpty())
            <div class="appointment-list mb-5">
              <h3 class="mb-3">Your Appointments</h3>
              @foreach($appointments as $appt)
                <div class="card p-3 mb-2">
                  <p><strong>Name:</strong> {{ $appt->name }}</p>
                  <p><strong>Matric/Staff ID:</strong> {{ $appt->matric_id }}</p>
                  <p><strong>Email:</strong> {{ $appt->email }}</p>
                  <p><strong>Phone:</strong> {{ $appt->phone_no }}</p>
                  <p><strong>Date:</strong> {{ $appt->date }}</p>
                  <p><strong>Department:</strong> {{ $appt->department }}</p>
                  <p><strong>Doctor:</strong> {{ $appt->doctor }}</p>
                  <p><strong>Notes:</strong> {{ $appt->message }}</p>
                </div>
              @endforeach
            </div>
   ```

5. Adding CSRF Token in the head
   ```blade
   <meta name="csrf-token" content="{{ csrf_token() }}">
   ```

   ---

   

