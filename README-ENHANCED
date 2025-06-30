# i-Clinic Enhanced – Database & File Security Focus

This is an enhanced version of the i-Clinic web-based system focusing specifically on:

- 🔐 **Database Security**
- 📁 **File Security**

## 🔐 Database Security

### ✅ Migrated from `root` to `admin` DB User

The Laravel application no longer uses the superuser `root` account to connect to the database.

A new database user `admin` was created with **restricted privileges**, following the **principle of least privilege (PoLP)**.

## 📁 6. File Security

Medical records may include uploaded files (images, PDFs). These files are protected as follows:

### ✅ Secure Upload Path
- Files are stored in `storage/app/secure_uploads` (NOT in `public`).
- File names are **obfuscated** using `Str::uuid()` to prevent guessing.

### ✅ Upload Validation
- File type limited to: `jpeg`, `jpg`, `png`, `gif`, `pdf`.
- Max file size: **2MB**.
- Only `admin` or `staff` can upload files.

### ✅ Download Protection
- Files are downloaded using a **controller method**, not served directly.
- This prevents direct public access to files by guessing URL paths.
