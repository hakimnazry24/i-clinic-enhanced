# IIUM i-Clinic: Your Digital Healthcare Solution

## **TEAM MEMBERS**

1. MUHAMMAD HAKIM BIN MD NAZRI 2110457
2. IMTENAN MIRAZ 2125101
3. KHAIRUNNISA BINTI ABDULLAH 2212506
4. RABIATUL ADAWIYAH BINTI ROHANY 2213530
5. NUR ALIFAH ILYANA BINTI MOHD ZAMAN 2217466

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

# **Authorization**

1- Custom Role Middleware
We created a custom middleware to check a user's role before allowing access to specific pages. For example, only an admin can access the admin dashboard.

2- Route Protection by Role
Certain routes (like admin or doctor pages) are protected using this middleware, so only users with the correct role can view them. Others will get a "403 Forbidden" error.

3- Middleware Registration
We registered the custom middleware in the Laravel system so it can be used across any route in the application.

4- Tested Role Access
We tested the system by logging in as different roles (admin, doctor, patient) to confirm that each role can only access its allowed pages.

