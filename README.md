# Online Exam Monitoring System

A comprehensive web-based online examination system with advanced cheating detection capabilities. Built with PHP (backend), MySQL (database), and JavaScript (frontend).

## Features

- 🔒 **Secure Authentication**: User registration and login with password hashing
- 🛡️ **Cheating Detection**: Monitors tab switches, window blur, and fullscreen exits
- ⏱️ **Timer Management**: Real-time countdown timer for exam duration
- 📊 **Result Tracking**: Comprehensive result storage with score calculation
- 📚 **Course Content**: Web development courses and learning materials
- 📱 **Responsive Design**: Works seamlessly on desktop, tablet, and mobile devices

## Requirements

- PHP 7.4 or higher
- MySQL 5.7 or higher (or MariaDB)
- Apache web server (or Nginx)
- Modern web browser (Chrome, Firefox, Edge, Safari)

## Installation

### Step 1: Clone or Download

Download the project files to your web server directory (e.g., `htdocs`, `www`, or `public_html`).

### Step 2: Database Setup

1. Open phpMyAdmin or your MySQL client
2. Create a new database or use the existing one
3. Import the database schema:
   ```sql
   mysql -u root -p exam_monitoring_system < db/database.sql
   ```
   Or manually execute the SQL file `db/database.sql` in phpMyAdmin

### Step 3: Configure Database Connection

Edit `includes/db.php` and update the database credentials:

```php
define('DB_HOST', 'localhost');
define('DB_USER', 'root');        // Your MySQL username
define('DB_PASS', '');            // Your MySQL password
define('DB_NAME', 'exam_monitoring_system');
```

### Step 4: Configure Web Server

#### For Apache:

1. Ensure `mod_rewrite` is enabled
2. Create a `.htaccess` file in the root directory (if needed) for URL rewriting
3. Set the document root to the project directory

#### For Nginx:

Configure your server block to point to the project directory.

### Step 5: Set File Permissions

Ensure PHP has write permissions (if needed for logs or uploads):
```bash
chmod 755 -R .
```

### Step 6: Access the Application

Open your web browser and navigate to:
```
http://localhost/online-exam-monitoring-system/
```
Or if using a virtual host:
```
http://your-domain.com/
```

## Project Structure

```
online-exam-monitoring-system/
│
├── index.php                 # Home page
├── rules.php                 # Exam rules page
├── learning.php              # Learning content page
├── courses.php               # Course listings page
├── start-exam.php           # Pre-exam setup page
├── exam.php                 # Main exam interface
├── result.php              # Results display page
│
├── includes/
│   ├── db.php              # Database connection
│   ├── auth.php            # Authentication functions
│   └── functions.php       # Utility functions
│
├── assets/
│   ├── css/
│   │   └── style.css       # Main stylesheet
│   ├── js/
│   │   ├── main.js         # General utilities
│   │   ├── exam.js         # Exam logic
│   │   └── detection.js    # Cheating detection
│   └── images/             # Image assets (if any)
│
├── templates/
│   ├── header.php          # Header template
│   └── footer.php          # Footer template
│
├── auth/
│   ├── login.php           # Login page
│   ├── register.php        # Registration page
│   └── logout.php          # Logout handler
│
└── db/
    └── database.sql        # Database schema and sample data
```

## Usage

### For Students/Users:

1. **Register**: Create a new account at `/auth/register.php`
2. **Login**: Access your account at `/auth/login.php`
3. **Read Rules**: Review exam rules at `/rules.php`
4. **Start Exam**: Click "Start Exam" and enter fullscreen mode
5. **Take Exam**: Answer 10 multiple-choice questions
6. **View Results**: Check your score and exam history

### For Administrators:

1. **Add Questions**: Manually insert questions into the `questions` table
2. **View Results**: Check the `results` table for all exam attempts
3. **User Management**: Manage users through the `users` table

## Cheating Detection

The system monitors the following activities:

- **Tab Switch**: Detects when user switches to another browser tab
- **Window Blur**: Detects when the browser window loses focus
- **Fullscreen Exit**: Detects when user exits fullscreen mode
- **Developer Tools**: Prevents access to browser developer tools (F12, Ctrl+Shift+I)

If any violation is detected, the exam is immediately terminated and marked as "cheated".

## Database Schema

### Users Table
- `id`: Primary key
- `name`: User's full name
- `email`: Unique email address
- `password`: Hashed password
- `created_at`: Registration timestamp

### Questions Table
- `id`: Primary key
- `question_text`: The question
- `option_a`, `option_b`, `option_c`, `option_d`: Answer options
- `correct_option`: Correct answer (a, b, c, or d)
- `created_at`: Creation timestamp

### Results Table
- `id`: Primary key
- `user_id`: Foreign key to users table
- `score`: Number of correct answers
- `total_questions`: Total questions in exam
- `time_taken`: Time taken in seconds
- `status`: 'completed' or 'cheated'
- `created_at`: Exam completion timestamp

## Security Features

- Password hashing using PHP's `password_hash()`
- SQL injection prevention with prepared statements and sanitization
- XSS protection with `htmlspecialchars()`
- Session management for authentication
- Secure routes (exam pages require login)

## Customization

### Change Exam Duration

Edit `exam.php` and modify:
```javascript
const examDuration = 600; // Change to desired seconds
```

### Add More Questions

Insert questions into the `questions` table:
```sql
INSERT INTO questions (question_text, option_a, option_b, option_c, option_d, correct_option) 
VALUES ('Your question?', 'Option A', 'Option B', 'Option C', 'Option D', 'a');
```

### Modify Styling

Edit `assets/css/style.css` to customize colors, fonts, and layout.

## Troubleshooting

### Database Connection Error
- Verify database credentials in `includes/db.php`
- Ensure MySQL service is running
- Check database name matches

### Fullscreen Not Working
- Ensure browser supports fullscreen API
- Check browser permissions
- Try a different browser

### Session Issues
- Ensure `session_start()` is called before any output
- Check PHP session configuration
- Verify file permissions

## Browser Compatibility

- Chrome 15+
- Firefox 10+
- Safari 6+
- Edge 12+

## License

This project is open source and available for educational purposes.

## Support

For issues or questions, please check the code comments or contact the development team.

## Future Enhancements

- Admin panel for question management
- Advanced analytics dashboard
- Email notifications
- PDF result generation
- Multiple exam types
- Question randomization improvements

---

**Note**: This is a demonstration system. For production use, implement additional security measures, error handling, and testing.

