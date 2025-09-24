<div align="center">
  <h1 align="center">SafeSupport 🫂</h1>
  <p align="center">
    A comprehensive mental health appointment booking system for students, counselors, and administrators.
  </p>
</div>

---

### 🚀 Powered By
<div align="center">
  <a href="https://laravel.com" target="_blank" rel="noopener noreferrer">
    <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel" />
  </a>
  <a href="https://www.php.net" target="_blank" rel="noopener noreferrer">
    <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP" />
  </a>
  <a href="https://www.javascript.com" target="_blank" rel="noopener noreferrer">
    <img src="https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black" alt="JavaScript" />
  </a>
  <a href="https://www.w3schools.com/css/" target="_blank" rel="noopener noreferrer">
    <img src="https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white" alt="CSS" />
  </a>
  <a href="https://laravel.com/docs/10.x/blade" target="_blank" rel="noopener noreferrer">
    <img src="https://img.shields.io/badge/Blade-black?style=for-the-badge&logo=laravel&logoColor=white" alt="Blade" />
  </a>
</div>

---

## ✨ Features

* **Student Dashboard:** Easily book and manage appointments, view counselor schedules, and access mental health resources.
* **Counselor Dashboard:** Manage your calendar, accept or decline appointments, and communicate with students.
* **Admin Dashboard:** Oversee all appointments, manage user accounts (students and counselors), and update system-wide settings.
* **Appointment Management:** A robust system for booking, rescheduling, and canceling appointments with real-time updates.
* **Resource Hub:** A curated collection of mental health articles, hotlines, and support links.

---

## 🛠️ Getting Started

### Prerequisites

* **PHP** >= 8.0
* **Composer**
* **Node.js** & **npm**
* A database (e.g., MySQL, PostgreSQL)

### Installation

1.  **Clone the repository:**
    ```bash
    git clone [https://github.com/your-username/safesupport.git](https://github.com/your-username/safesupport.git)
    cd safesupport
    ```
2.  **Install PHP dependencies:**
    ```bash
    composer install
    ```
3.  **Install NPM dependencies:**
    ```bash
    npm install
    npm run dev
    ```
4.  **Configure your environment:**
    * Copy the `.env.example` file to `.env`:
        ```bash
        cp .env.example .env
        ```
    * Generate an application key:
        ```bash
        php artisan key:generate
        ```
    * Update your database credentials in the `.env` file.
5.  **Run migrations and seed the database:**
    ```bash
    php artisan migrate --seed
    ```
6.  **Start the local development server:**
    ```bash
    php artisan serve
    ```

You can now access the application at `http://127.0.0.1:8000`.

---

## 🤝 Contributing

We welcome contributions! Please feel free to open a pull request or submit an issue on the GitHub repository.

---

## 📄 License

This project is licensed under the MIT License. See the `LICENSE` file for details.
