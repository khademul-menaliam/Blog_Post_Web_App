# Blog Post Web App

This is a simple and easy-to-use web application that lets you create, edit, and delete blog posts. It's built with Laravel, a popular PHP framework, which helps keep everything organized and secure.

## Features

- **User Authentication:** Users can register and log in securely.
- **Create, Read, Update, Delete (CRUD):** Manage blog posts easily.
- **Rich Text Editor:** Write posts with formatting options.
- **Responsive Design:** Looks good on phones, tablets, and desktops.
- **Category Management:** Organize posts into different topics or categories.

## Installation Guide

### What You Need First

Before you start, make sure your computer has these installed:

- **PHP 8.0 or higher:** The programming language Laravel uses.
- **Composer:** A tool to manage PHP packages.
- **Laravel Installer:** To create and manage Laravel projects.
- **Node.js and npm:** For managing frontend assets like JavaScript and CSS.

If you don’t have these, you can download them from their official websites.

### Step-by-Step Setup

1. **Get the project files:**

   Open your terminal (Command Prompt, PowerShell, or Bash) and run:

   ```bash
   git clone https://github.com/khademul-menaliam/Blog_Post_Web_App.git
   cd Blog_Post_Web_App
   ```

   This copies the project to your computer and moves into the project folder.

2. **Install PHP dependencies:**

   Run:

   ```bash
   composer install
   ```

   This downloads all the PHP packages your app needs.

3. **Set up your environment:**

   Copy the example environment file by running:

   ```bash
   cp .env.example .env
   ```

   This `.env` file contains important settings like your database details.

4. **Generate an application key:**

   Run:

   ```bash
   php artisan key:generate
   ```

   This secures your application with a unique key.

5. **Configure the database:**

   Open the `.env` file in a text editor. Find the database section and fill in your database name, username, and password.

6. **Run database migrations:**

   This creates the necessary tables in your database:

   ```bash
   php artisan migrate
   ```

7. **Install frontend dependencies:**

   Run:

   ```bash
   npm install
   ```

   This installs JavaScript and CSS libraries the app needs.

8. **Compile frontend assets:**

   Build your CSS and JavaScript files with:

   ```bash
   npm run dev
   ```

9. **Run the application:**

   Start the Laravel development server:

   ```bash
   php artisan serve
   ```

   Your app will be available at `http://localhost:8000`.

### Now you can open your browser and start using your Blog Post Web App!

## How to Use

- Log in or register an account.
- Create new blog posts using the editor.
- Edit or delete posts as needed.
- Manage categories to keep your blog organized.
- View all published posts on the public site.

## Deployment

If you want to put your app online (so others can access it), check out the [deployment guide](deployment/) for tips and instructions.

## Contributing

Want to help improve this project? Great! You can:

- Fork the repository
- Make your changes
- Send a pull request for review

We welcome any contributions!

## License

This project is licensed under the MIT License.
