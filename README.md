# CampusConnect 🎓  
A role-based campus event management platform built using **Core PHP, MySQL, Bootstrap, and JavaScript**.

CampusConnect centralizes all campus clubs and events into a single platform where students can explore events, register seamlessly, and view event schedules through an interactive calendar. Admins can manage clubs, events, galleries, and track analytics.

---

## 🚀 Features

### 👨‍💼 Admin Features
- Secure admin authentication
- Add, edit, and delete clubs
- Create, update, and remove events
- Upload event-wise gallery images
- Interactive event calendar with edit/delete options
- View analytics dashboard:
  - Total events
  - Total clubs
  - Total users
  - Event-wise registration counts

---

### 🎓 Student Features
- Secure student authentication
- View all upcoming and past events
- Register for events (one registration per event enforced)
- Cannot register for past events
- View event details via interactive calendar popup
- See event galleries
- Live registration count for each event

---

### 📅 Event Calendar
- Built using **FullCalendar.js**
- Color-coded events:
  - 🔵 Upcoming events
  - ⚫ Past events
- Clickable events open a detailed popup with:
  - Event info
  - Gallery images
  - Registration button (students)
  - Edit/Delete options (admins)
- Fully responsive (mobile-friendly list view)

---

## 🛠 Tech Stack

### Frontend
- HTML5
- CSS3
- Bootstrap 5
- JavaScript

### Backend
- Core PHP (Procedural)
- MySQL
- PHP Sessions for authentication

### Database
- MySQL (phpMyAdmin)

### Libraries & Tools
- FullCalendar.js
- XAMPP (Apache, MySQL, PHP)
- Git & GitHub
- VS Code

---

## 🗂 Project Structure

campusConnect/
│
├── admin/
│ ├── dashboard.php
│ ├── add-club.php
│ ├── add-event.php
│ ├── edit-event.php
│ ├── delete-event.php
│ ├── upload-gallery.php
│ └── analytics.php
│
├── auth/
│ ├── login.php
│ ├── register.php
│ └── logout.php
│
├── student/
│ ├── dashboard.php
│ ├── events.php
│ └── register-event.php
│
├── public/
│ ├── index.php
│ ├── calendar.php
│ ├── gallery.php
│ └── get-event.php
│
├── config/
│ └── db.php
│
├── uploads/
│ └── images/
│
└── README.md

---

## 🗃 Database Schema

**Tables Used**
- `users` (admin, student roles)
- `clubs`
- `events`
- `event_registrations`
- `galleries`

Relational design with foreign keys for data integrity.

---

## ⚙️ Setup Instructions

### 1️⃣ Install Requirements
- Install **XAMPP**
- Start **Apache** and **MySQL**

### 2️⃣ Clone Repository
```bash
git clone https://github.com/anujakande/campusConnect.git

3️⃣ Move Project

Move the folder to:

C:\xampp\htdocs\

4️⃣ Database Setup

- Open http://localhost/phpmyadmin
- Create database: campus_connect
- Import the provided SQL schema

5️⃣ Run Project

Open browser:

http://localhost/campusConnect/public/index.php

🔐 Default Admin Credentials
Email: admin@campus.com
Password: password

🔮 Future Enhancements

- Email notifications for registrations
- Event reminders
- Admin approval system