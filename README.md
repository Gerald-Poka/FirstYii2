# 📂 Job Management System

![Job Management System](https://via.placeholder.com/800x400?text=Job+Management+System)

A comprehensive job board and management platform built with the **Yii2 Framework**. This system enables administrators to manage job listings, categories, skills, and users through a clean, responsive UI.

---

## ✨ Features

- ✅ **Modern UI with Bootstrap 5**
- ✅ **Job Management**: Add, edit, and delete job listings
- ✅ **Category System**: Organize jobs by custom categories
- ✅ **Skills Tracking**: Assign required skills to jobs
- ✅ **Advanced Filtering**: Filter jobs by multiple parameters
- ✅ **User Management**: Secure admin panel access
- ✅ **Responsive Forms** with client-side validation
- ✅ **Status Management**: Draft, Published, Closed
- ✅ **Expiration System**: Auto-remove expired job listings

---

## 🔧 Requirements

- PHP 7.4+
- MySQL 5.7+ / MariaDB 10.2+
- Composer
- Git
- XAMPP / WAMP / LAMP stack

---

## 🚀 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/Gerald-Poka/job-management-system.git
Navigate to the project directory

bash
Copy
Edit
cd job-management-system
Install PHP dependencies

bash
Copy
Edit
composer install
Create the database

sql
Copy
Edit
CREATE DATABASE learning;
Configure database in config/db.php

php
Copy
Edit
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=learning',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
];
Run database migrations

bash
Copy
Edit
php yii migrate
(Optional) Setup Virtual Host

apache
Copy
Edit
<VirtualHost *:80>
    ServerName job-management.local
    DocumentRoot "/path/to/job-management-system/web"

    <Directory "/path/to/job-management-system/web">
        Options +FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
🔐 Admin Access
URL: /admin

Username: admin

Password: admin123

🧭 System Overview
➤ Job Management
Add company name, job title, type, salary, and requirements

Set expiration date and publication status

Assign categories and skills

➤ Category Management
Modern card-based interface

Add/edit/delete categories

SweetAlert2 confirmations

Status indicators (Active/Inactive)

🗂️ Project Structure
bash
Copy
Edit
project/
├── assets/               # Asset bundles
├── commands/             # Console commands
├── components/           # Custom components
├── config/               # App configurations
├── controllers/
│   └── admin/            # Admin controllers
├── migrations/           # DB migrations
├── models/               # ActiveRecord models
├── views/
│   └── admin/
│       ├── jobs/         # Job management views
│       └── job-categories/ # Category management views
├── web/                  # Web-accessible files
│   ├── css/
│   └── js/
└── widgets/              # Custom Yii2 widgets
🖼️ Screenshots
📁 Job Categories Management


📝 Job Creation Form


🔍 Job Details View


🔭 Development Roadmap
 Public job seeker portal

 Application submission system

 Candidate tracking system

 Email notifications

 Enhanced search and filters

 API for job aggregators

 Mobile app integration

🤝 Contributing
Fork this repository

Create a new branch: git checkout -b feature/amazing-feature

Commit your changes: git commit -m 'Add amazing feature'

Push the branch: git push origin feature/amazing-feature

Open a Pull Request

📄 License
This project is licensed under the MIT License. See the LICENSE file for more info.

👤 Author
Gerald Ndyamukama
Full Stack Developer | Yii2 Specialist

📧 Email: geraldndyamukama39@gmail.com
🐙 GitHub: @Gerald-Poka
📍 Location: Dar es Salaam, Tanzania

"Building elegant solutions to complex problems."
