# CampusVoice - College Complaint/Suggestion Management System

CampusVoice is a comprehensive web-based complaint and suggestion management system designed to bridge the communication gap between students and college administrators. The platform enables students to submit, track, and manage their complaints while providing administrators with tools to efficiently handle and resolve issues.

## 🚀 Features

### For Students
- **User Registration & Authentication**: Secure signup and login system with email verification
- **Complaint Submission**: Submit detailed complaints/suggestions with file attachments (IMG, PDF, DOCX, etc Upto 5MB)
- **Suggestion System**: Share suggestions for campus improvements
- **Real-time Tracking**: Monitor complaint status and progress
- **Dashboard**: Personal dashboard to view all submitted complaints
- **Email Notifications**: Receive updates via email when complaint status changes
- **Secret Identity**: Identity of students is kept secret. Admin cannot see who the student is.

### For Administrators
- **Admin Dashboard**: Comprehensive overview of all complaints/suggestions and statistics
- **Complaint Management**: Review, assign, and update complaint status
- **Department-wise Access**: Role-based access control for different departments
- **Communication Tools**: Add remarks and communicate with students
- **File Management**: Handle attachments and supporting documents

### System Features
- **Responsive Design**: Mobile-friendly interface
- **Email Integration**: PHPMailer integration for notifications
- **File Upload**: Support for complaint attachments
- **Status Tracking**: Real-time status updates (Pending, In Progress, Resolved, Invalid)
- **Search & Filter**: Advanced search and filtering capabilities
- **Security**: Session management and secure authentication

## 🛠️ Technology Stack

- **Frontend**: HTML5, CSS3, JavaScript
- **Backend**: PHP 7.4+
- **Database**: MySQL/MariaDB
- **Email**: PHPMailer
- **Server**: Apache/Nginx

## 📋 Prerequisites

- PHP 7.4 or higher
- MySQL 5.7 or MariaDB 10.2+
- Apache/Nginx web server
- Composer (for PHPMailer dependencies)

## 🔧 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/yourusername/campusvoice.git
   cd campusvoice
   ```

2. **Database Setup**
   - Import the database schema:
   ```bash
   mysql -u username -p complaintbox < db/complaintbox.sql
   ```

3. **Configure Database Connection**
   - Update database credentials in `connection/conn.php`:
   ```php
   $conn = mysqli_connect("localhost", "your_username", "your_password", "complaintbox");
   ```

4. **Email Configuration**
   - Configure SMTP settings in the mail configuration files
   - Update email credentials for notification system

5. **File Permissions**
   ```bash
   chmod 755 attachments/
   chmod 644 *.php
   ```

6. **Web Server Setup**
   - Point your web server document root to the project directory
   - Ensure mod_rewrite is enabled (for Apache)

## 📁 Project Structure

```
CampusVoice/
├── Admin/                      # Admin panel files
│   ├── admin_login.php        # Admin login page
│   ├── admin_signup.php       # Admin registration
│   └── dashboard.php          # Admin dashboard
├── User/                      # Student user files
│   ├── complaint.php          # Complaint submission form
│   ├── dashboard.php          # Student dashboard
│   └── view.php              # View complaints
├── connection/                # Database connections
│   ├── conn.php              # Main database connection
│   ├── session.php           # Student session management
│   └── admin_session.php     # Admin session management
├── css/                      # Stylesheets
│   ├── style.css            # Main stylesheet
│   ├── login.css            # Login page styles
│   ├── dashboard.css        # Dashboard styles
│   ├── admin_dashboard.css  # Admin dashboard styles
│   ├── complaint.css        # Complaint form styles
│   ├── view.css            # View page styles
│   └── otp.css             # OTP verification styles
├── db/                      # Database files
│   └── complaintbox.sql    # Database schema
├── Img/                    # Image assets
│   ├── logo.jpg           # Application logo
│   ├── login.jpg          # Login page background
│   ├── welcome1.png       # Welcome images
│   ├── welcome2.png
│   └── [various icons]    # UI icons and images
├── mail/                   # Email functionality
│   └── [email templates]  # Email templates and OTP system
├── PHPMailer/             # PHPMailer library
├── attachments/           # File upload directory
├── support/              # Support files
├── index.php            # Landing page
├── login.php           # Student login
├── signup.php         # Student registration
└── README.md         # Project documentation
```

## 🗄️ Database Schema

### Main Tables

#### `student`
- Student information and authentication
- Fields: id, rno, name, class, year, email, password

#### `admin`
- Administrator accounts and departments
- Fields: id, name, email, password, department

#### `complaint_suggestion`
- All complaints and suggestions
- Fields: stud_id, complaint_id, category, subject, description, date, time, status

#### `class`
- Available classes/courses
- Fields: cid, cname

#### `attachments`
- File attachments for complaints
- Fields: complaint_id, file_name, size, type

#### `remarks`
- Communication between students and admins
- Fields: complaint_id, sender, message, file_name, date, time

#### `admin_complaint`
- Assignment of complaints to administrators
- Fields: admin_id, complaint_id

## 🚦 Usage

### For Students

1. **Registration**
   - Visit the signup page
   - Fill in student details (name, roll number, class, year, email)
   - Verify email through OTP
   - Login with student ID or email

2. **Submit Complaint**
   - Navigate to "Submit Complaint"
   - Choose category (Complaint/Suggestion)
   - Fill in subject and detailed description
   - Attach supporting files if needed
   - Submit for review

3. **Track Progress**
   - Use "Track Complaints" to view all submissions
   - Monitor status changes and admin responses
   - Receive email notifications for updates

### For Administrators

1. **Login**
   - Access admin login page
   - Login with admin credentials
   - View dashboard with complaint statistics

2. **Manage Complaints**
   - Review pending complaints
   - Assign complaints to appropriate departments
   - Update status and add remarks
   - Communicate with students through the system

## 🔐 Security Features

- **Session Management**: Secure session handling for both students and admins
- **Input Validation**: Server-side validation for all user inputs
- **SQL Injection Prevention**: Prepared statements and input sanitization
- **File Upload Security**: Restricted file types and size limits
- **Password Security**: Minimum password requirements
- **Role-based Access**: Separate access levels for students and admins

## 📧 Email System

The system uses PHPMailer for:
- OTP verification during registration
- Complaint status notifications
- Admin alerts for new complaints
- Resolution confirmations

## 🎨 UI/UX Features

- **Responsive Design**: Works on desktop, tablet, and mobile devices
- **Intuitive Navigation**: Easy-to-use interface for all user types
- **Visual Status Indicators**: Color-coded status tracking
- **File Preview**: Preview attachments before download
- **Search Functionality**: Quick search through complaints

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📝 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📞 Support

For support and queries:
- Email: support@campusvoice.edu
- Phone: +21 123-45678

## 🔄 Version History

- **v1.0.0** - Initial release with core functionality
- **v1.1.0** - Added email notifications and file attachments
- **v1.2.0** - Enhanced admin dashboard and reporting features

---

**CampusVoice** - Making your campus experience better through effective complaint management.
