# Laravel Recipe API

A RESTful API for managing recipes, built with Laravel. This project features user authentication (JWT), recipe CRUD operations, bookmarking, approval workflow, and basic admin/user management.

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-00758F?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/JWT-black?style=for-the-badge&logo=jsonwebtokens&logoColor=white" alt="JWT">
</p>

## ✨ Features

- **User registration & JWT authentication**
- **CRUD recipes:** create, read, update, delete
- **Bookmark recipes**
- **Recipe approval workflow (admin)**
- **History tracking**
- **Admin and user management**

## 🚀 Technologies

- Laravel (PHP framework)
- PHP
- MySQL
- JWT Auth for API authentication

## 📦 Installation

1. **Clone the repository**
   ```bash
   git clone https://github.com/EvelinSA05/laravel-recipe.git
   cd laravel-recipe
   ```
2. **Install dependencies**
   ```bash
   composer install
   npm install
   npm run dev
   ```
3. **Environment setup**
   - Copy `.env.example` to `.env` and edit your database configuration.
   - Generate app key:
     ```bash
     php artisan key:generate
     ```
   - Set JWT secret:
     ```bash
     php artisan jwt:secret
     ```
4. **Run migrations**
   ```bash
   php artisan migrate
   ```
5. **Run the server**
   ```bash
   php artisan serve
   ```

## 🛣️ API Endpoints

Example endpoints (see [`routes/api.php`](https://github.com/EvelinSA05/laravel-recipe/blob/main/routes/api.php)):

- `POST   /api/register` - Register user
- `POST   /api/login` - Login & get JWT token
- `POST   /api/logout` - Logout
- `GET    /api/reseps` - List all recipes
- `GET    /api/reseps/search` - Search recipes
- `GET    /api/reseps/{id}` - Get recipe details
- `POST   /api/reseps` - Create recipe
- `PUT    /api/reseps/{id}` - Update recipe
- `DELETE /api/reseps/{id}` - Delete recipe
- `POST/GET/DELETE /api/reseps/{id}/bookmark` - Manage bookmarks
- `POST/GET/DELETE /api/reseps/{id}/approve` - Approve recipes (admin)
- `GET/POST/DELETE /api/histories` - Manage histories
- `GET/POST/DELETE /api/admin` - Manage admins
- `GET/POST/DELETE /api/user` - Manage users

## 📂 Main Structure

- `app/Http/Controllers/` - API controllers for recipes, users, admins, history, etc.
- `routes/api.php` - API routes
- `routes/web.php` - Web routes (for basic testing)
- `config/jwt.php` - JWT authentication config
- `resources/views/` - Blade views (if needed for basic web view)

## 📝 Customization

- Add more endpoints or business logic in the respective controller.
- Update JWT settings in `.env` and `config/jwt.php` as needed.

## 🤝 Contribution

Feel free to fork and submit pull requests for improvements or bugfixes!

## 📬 Contact

- [GitHub - EvelinSA05](https://github.com/EvelinSA05)

---

> **Note:**  
> This is a backend API project. For a complete client app, build a frontend (web or mobile) and connect to these endpoints.
>  
> For more code and details, see the [repository source](https://github.com/EvelinSA05/laravel-recipe).
