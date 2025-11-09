# Online Exam Monitoring System

A comprehensive web-based online examination system with advanced cheating detection capabilities. Built with PHP (backend), MySQL (database), and JavaScript (frontend).

## Features

-  **Secure Authentication**: User registration and login with password hashing
-  **Cheating Detection**: Monitors tab switches, window blur, and fullscreen exits
-  **Timer Management**: Real-time countdown timer for exam duration
-  **Result Tracking**: Comprehensive result storage with score calculation
-  **Course Content**: Web development courses and learning materials
-  **Responsive Design**: Works seamlessly on desktop, tablet, and mobile devices

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
├── log_event.php           # Violation event logging handler
│
├── includes/
│   ├── config.php          # Configuration and database setup
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
    ├── database.sql        # Complete database schema and sample data
    └── violations_tables.sql  # Additional violation tracking tables (legacy)
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
3. **Monitor Violations**: Review `exam_violations` table for detailed violation logs
4. **Session Management**: Track active and completed sessions in `exam_sessions` table
5. **User Management**: Manage users through the `users` table

## Cheating Detection

The system monitors the following activities:

- **Tab Switch**: Detects when user switches to another browser tab
- **Window Blur**: Detects when the browser window loses focus
- **Fullscreen Exit**: Detects when user exits fullscreen mode (15-second grace period to return)
- **Cursor Tracking**: Monitors mouse/pointer leaving the browser window or document area
- **Developer Tools**: Prevents access to browser developer tools (F12, Ctrl+Shift+I, Ctrl+U)
- **Context Menu**: Disables right-click context menu during exam

### Violation Escalation System

The system uses a **3-strike policy** for violations:

1. **First Violation**: Warning message displayed
2. **Second Violation**: Final warning message displayed
3. **Third Violation**: Exam immediately terminated and marked as "cheated"

All violations are logged to the database with timestamps and event details for administrative review.

## Database Schema

### Users Table
- `user_id`: Primary key
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

### Exam Sessions Table
- `session_id`: Primary key
- `user_id`: Foreign key to users table
- `started_at`: Session start timestamp
- `ended_at`: Session end timestamp (NULL if active)
- `ended_reason`: Reason for ending ('completed', 'terminated', 'timeout', 'cheated')
- `score`: Final exam score (if completed)
- `created_at`: Session creation timestamp

### Exam Violations Table
- `violation_id`: Primary key
- `session_id`: Foreign key to exam_sessions table
- `user_id`: Foreign key to users table
- `event_type`: Type of violation (e.g., 'blur', 'fullscreen_exit', 'cursor_leave')
- `event_time`: Timestamp of the violation
- `details`: Additional details about the violation

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
- Real-time violation tracking and logging
- Transaction-based database operations for data integrity
- Event debouncing to prevent duplicate violation counts

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

## Recent Updates

### Latest Improvements (November 2025)

- ✅ **Enhanced Cursor Detection**: Improved mouse/pointer tracking to detect when cursor leaves the browser window
- ✅ **Improved Exit Logic**: Refactored violation handling with 3-strike escalation system
- ✅ **Session Management**: Added comprehensive exam session tracking with `exam_sessions` table
- ✅ **Violation Logging**: Detailed violation tracking with timestamps and event types in `exam_violations` table
- ✅ **Fullscreen Grace Period**: Reduced countdown timer to 15 seconds for returning to fullscreen mode
- ✅ **Event Debouncing**: Prevents duplicate violation counts from rapid-fire events
- ✅ **Better Error Handling**: Enhanced error messages and database connection management

## Future Enhancements

- Admin panel for question management
- Advanced analytics dashboard
- Email notifications
- PDF result generation
- Multiple exam types
- Question randomization improvements
- Real-time violation monitoring dashboard

---

**Note**: This is a demonstration system. For production use, implement additional security measures, error handling, and testing.

