# LittleIdeas — Login/Signup Backend

Local setup steps:

1. Install a PHP+MySQL environment (XAMPP, WAMP) and start Apache + MySQL.
2. Create the database and table:
   - Import `create_db.sql` into your MySQL server (phpMyAdmin or CLI).
3. Configure DB credentials:
   - Edit `db.php` and set `$user` and `$pass` to match your MySQL setup.
4. Copy project files into your web root (e.g., `C:\xampp\htdocs\littleideas`) or run a local PHP server.
   - If using built-in PHP server: `php -S localhost:8000` from project folder.
5. Open `http://localhost/.../signup.html` in your browser to create an account, then login.

Notes & security reminders:
- Passwords are hashed with `password_hash()` and verified with `password_verify()`.
- Use HTTPS in production, store DB credentials outside webroot, add CSRF protection, and rate-limit login attempts.

Files added/modified:
- Added: `backend/db.php`, `backend/signup.php`, `backend/login.php`, `backend/logout.php`, `backend/create_db.sql`, and `dashboard.php` (in root), `README.md`
- Updated: `login.html`, `signup.html` (added form actions & message script)
