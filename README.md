# Resume Builder - PHP Web Application

## 📋 Project Overview

Resume Builder is a full-featured web application that allows users to create, manage, and download professional resumes. Built with PHP and MySQL, this application provides a user-friendly interface for building resumes with personal information, work experience, education, and skills.

## ✨ Key Features

### User Authentication & Security
- **User Registration**: Create new accounts with email verification
- **Secure Login**: Password-based authentication with MD5 encryption
- **Forgot Password**: OTP-based password recovery via email
- **Session Management**: Secure user sessions with authentication checks
- **Access Control**: Protected pages require login, auth pages redirect logged-in users

### Resume Management
- **Create Resumes**: Build professional resumes with comprehensive personal details
- **Edit Resumes**: Update existing resume information anytime
- **Delete Resumes**: Remove unwanted resumes
- **View Resumes**: Preview resumes before downloading
- **PDF Download**: Generate and download resumes as PDF files
- **Multiple Resumes**: Create and manage multiple resume versions

### Resume Components
- **Personal Information**: Name, email, phone, address, date of birth, gender, religion, nationality, marital status
- **Professional Objective**: Career goals and objectives
- **Work Experience**: Add multiple job positions with company details, duration, and descriptions
- **Education**: Add educational qualifications with institution details
- **Skills**: List professional skills and competencies
- **Languages**: Languages known
- **Hobbies**: Personal interests and hobbies

## 📁 File Structure & Documentation

### Root Directory Files (Main Pages)

| File | Description |
|------|-------------|
| `login.php` | User login page with email and password form. Validates credentials and redirects to dashboard on success. |
| `register.php` | New user registration page. Collects full name, email, and password. Validates for existing users. |
| `forgot-password.php` | Password recovery initiation page. Sends 6-digit OTP to user's email for verification. |
| `verification.php` | OTP verification page. Validates the 6-digit code sent to email for password reset. |
| `change-password.php` | New password setup page after successful OTP verification. |
| `account.php` | User profile management page. Allows updating name, email, and password. |
| `myresumes.php` | Dashboard displaying all user resumes with options to view, edit, or delete. Shows last updated timestamp. |
| `createresume.php` | Form to create a new resume with all personal and professional details. |
| `updateresume.php` | Edit existing resume page. Pre-populates form with current data. Includes modals for adding experience, education, and skills. |
| `resume.php` | Resume preview and PDF generation page. Displays formatted resume with print-friendly styling. |

### Actions Directory (`actions/`)

All form submissions are handled by dedicated action files for better security and organization:

| File | Description |
|------|-------------|
| `login.action.php` | Processes login form. Validates credentials against database, sets session on success. |
| `register.action.php` | Handles user registration. Checks for duplicate emails, hashes password with MD5, creates new user record. |
| `logout.action.php` | Destroys user session and redirects to login page. |
| `sendcode.action.php` | Generates and sends 6-digit OTP via email for password recovery using PHPMailer. |
| `verifyotp.action.php` | Validates OTP entered by user against stored session value. |
| `changepassword.action.php` | Updates user password in database after successful verification. |
| `updateprofile.action.php` | Updates user account information (name, email, password). |
| `createresume.action.php` | Processes new resume creation. Generates unique slug, sets timestamps, associates with user ID. |
| `updateresume.action.php` | Updates existing resume information in database. |
| `deleteresume.action.php` | Removes resume record and all associated data (experience, education, skills). |
| `addexperience.action.php` | Adds new work experience entry to a specific resume. |
| `deleteexp.action.php` | Removes specific work experience entry. |
| `addeducation.action.php` | Adds new education qualification to a resume. |
| `deleteedu.action.php` | Removes specific education entry. |
| `addskill.action.php` | Adds new skill to a resume. |
| `deleteskill.action.php` | Removes specific skill entry. |

### Assets Directory (`Assets/`)

#### Class Files (`Assets/class/`)
| File | Description |
|------|-------------|
| `database.class.php` | Database connection class using MySQLi. Configures host, username, password, and database name. Creates singleton connection instance. |
| `function.class.php` | Core utility functions class. Handles sessions, authentication, redirects, alerts, error messages, and generates random strings for slugs. |

#### Includes (`Assets/includes/`)
| File | Description |
|------|-------------|
| `header.php` | Common header template. Includes database and function classes, starts HTML document, loads Bootstrap CSS, Bootstrap Icons, sets page title, and includes custom styles. |
| `footer.php` | Common footer template. Loads Bootstrap JS, SweetAlert2 for notifications, jQuery, and executes error/alert display functions. |
| `navbar.php` | Navigation bar component with logo, app name, account link, and logout button. |

#### Images (`Assets/images/`)
| File/Folder | Description |
|-------------|-------------|
| `logo-0.png`, `logo-2.png` | Application logos used in header and authentication pages |
| `Background.jpeg` | Background image for authentication pages |
| `tiles/` | Contains 23 tile images (tile1.png to tile23.jpg) used for resume templates or UI elements |

#### Contents (`Assets/Contents/`)
| File | Description |
|------|-------------|
| `Screenshot_1.png`, `Screenshot_2.png`, `Screenshot_3.png` | Application screenshots for documentation |
| `Stats.txt` | Project statistics or metrics |
| `table pic.png` | Database schema or table structure image |

#### Packages (`Assets/packages/`)
| Folder | Description |
|--------|-------------|
| `phpmailer/` | PHPMailer library for sending emails (OTP verification, notifications). Includes all language files and core classes (PHPMailer.php, SMTP.php, POP3.php, Exception.php, OAuth.php). |

### Bin Directory (`bin/`)
| File | Description |
|------|-------------|
| `README.md` | Additional documentation |
| `Resume Builder UI.zip` | UI design files or templates |
| `Resume_builder.zip` | Complete project archive |
| `tile.png` | Tile image resource |

## 🗄️ Database Structure

### Tables

#### 1. `users`
Stores registered user information
- `id` (INT, Primary Key, Auto Increment)
- `full_name` (VARCHAR) - User's full name
- `email_id` (VARCHAR) - Unique email address
- `password` (VARCHAR) - MD5 hashed password

#### 2. `resumes`
Stores resume header information
- `id` (INT, Primary Key, Auto Increment)
- `user_id` (INT, Foreign Key) - Links to users table
- `slug` (VARCHAR) - Unique identifier for resume URL
- `resume_title` (VARCHAR) - Title of the resume
- `full_name` (VARCHAR) - Name on resume
- `email_id` (VARCHAR) - Contact email
- `phone_no` (VARCHAR) - Contact number
- `objective` (TEXT) - Career objective
- `dob` (DATE) - Date of birth
- `gender` (VARCHAR)
- `religion` (VARCHAR)
- `nationality` (VARCHAR)
- `marital_status` (VARCHAR)
- `hobbies` (VARCHAR)
- `languages` (VARCHAR)
- `address` (TEXT)
- `updated_at` (INT, Unix Timestamp) - Last modification time

#### 3. `experiences`
Stores work experience entries
- `id` (INT, Primary Key, Auto Increment)
- `resume_id` (INT, Foreign Key) - Links to resumes table
- `position` (VARCHAR) - Job title/role
- `company` (VARCHAR) - Employer name
- `started` (VARCHAR) - Start date
- `ended` (VARCHAR) - End date
- `job_desc` (TEXT) - Job description

#### 4. `educations`
Stores educational qualifications
- `id` (INT, Primary Key, Auto Increment)
- `resume_id` (INT, Foreign Key) - Links to resumes table
- `course` (VARCHAR) - Degree/Course name
- `institute` (VARCHAR) - Institution name
- `started` (VARCHAR) - Start date
- `ended` (VARCHAR) - End date

#### 5. `skills`
Stores professional skills
- `id` (INT, Primary Key, Auto Increment)
- `resume_id` (INT, Foreign Key) - Links to resumes table
- `skill` (VARCHAR) - Skill name

## 🔧 Technologies Used

### Backend
- **PHP 7+**: Server-side scripting language
- **MySQL/MariaDB**: Relational database management system
- **MySQLi**: PHP extension for database operations

### Frontend
- **HTML5**: Markup language
- **CSS3**: Styling with custom styles and Bootstrap overrides
- **Bootstrap 5.3.2**: Frontend framework for responsive design
- **Bootstrap Icons 1.11.1**: Icon library
- **JavaScript**: Client-side scripting
- **jQuery 3.7.1**: JavaScript library for DOM manipulation
- **SweetAlert2**: Beautiful alert and notification dialogs
- **html2pdf.js**: Client-side PDF generation library

### Email Service
- **PHPMailer**: Email sending library for PHP with SMTP support

## 🚀 Installation & Setup

### Prerequisites
- PHP 7.0 or higher
- MySQL or MariaDB database server
- Web server (Apache/Nginx)
- SMTP server access (for email features)

### Installation Steps

1. **Clone or Download**
   ```bash
   # Extract the project to your web server directory
   # For XAMPP: htdocs/Projects/Resume Builder/
   # For WAMP: www/Resume Builder/
   ```

2. **Database Setup**
   - Create a new database named `resumebuilder`
   - Import the database schema (create tables: users, resumes, experiences, educations, skills)
   - Update database credentials in `Assets/class/database.class.php` if needed:
     ```php
     private $host = 'localhost';
     private $username = 'root';
     private $password = '';
     private $database = 'resumebuilder';
     ```

3. **Email Configuration (for OTP feature)**
   - Configure SMTP settings in `actions/sendcode.action.php`
   - Update sender email and password
   - Ensure PHPMailer library is properly included

4. **Access Application**
   - Open browser and navigate to: `http://localhost/Projects/Resume%20Builder/`
   - Register a new account or use existing credentials

## 🔐 Security Features

1. **Password Encryption**: All passwords are hashed using MD5 before storage
2. **SQL Injection Prevention**: Uses `real_escape_string()` for user inputs
3. **Session Management**: Secure PHP sessions for authentication state
4. **Access Control**: 
   - `AuthPage()`: Redirects non-authenticated users to login
   - `nonAuthPage()`: Redirects authenticated users away from auth pages
5. **Input Validation**: Required field validation on all forms
6. **CSRF Protection**: Form submissions handled through dedicated action files

## 📱 User Flow

1. **Registration** → `register.php` → `actions/register.action.php` → `login.php`
2. **Login** → `login.php` → `actions/login.action.php` → `myresumes.php`
3. **Create Resume** → `createresume.php` → `actions/createresume.action.php` → `myresumes.php`
4. **Edit Resume** → `updateresume.php` → Update basic info or add experience/education/skills via modals → `actions/updateresume.action.php` or specific add actions
5. **View/Download** → `resume.php` → PDF generation using html2pdf.js
6. **Password Recovery** → `forgot-password.php` → `actions/sendcode.action.php` → `verification.php` → `actions/verifyotp.action.php` → `change-password.php` → `actions/changepassword.action.php` → `login.php`

## 🎨 UI/UX Features

- **Responsive Design**: Bootstrap 5 ensures mobile-friendly interface
- **Modern Styling**: Clean, professional appearance with custom CSS
- **Interactive Elements**: 
  - Modal dialogs for adding experience, education, and skills
  - SweetAlert2 notifications for success/error messages
  - Bootstrap Icons for visual enhancement
- **Print-Friendly Resume**: Specially styled for PDF generation
- **Background Images**: Aesthetic background for authentication pages

## 📝 Additional Notes

- **Timezone**: Application uses 'Asia/Kolkata' (Indian Standard Time) for timestamps
- **File Uploads**: Currently supports text-based data; file upload features can be added
- **Multi-Language Support**: PHPMailer includes language files for internationalization
- **Extensible Architecture**: Easy to add new resume sections or features

## 🤝 Contributing

This is a complete, production-ready resume builder application suitable for educational purposes, portfolio projects, or as a foundation for more advanced resume building platforms.

---

**Created with PHP, MySQL, Bootstrap, and ❤️**
