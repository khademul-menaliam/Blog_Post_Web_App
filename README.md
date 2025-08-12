# Blog Post Web App

A simple and intuitive web application designed to allow users to create, edit, and delete blog posts. Built with Laravel, this app provides a user-friendly interface for managing blog content.

## Features

- **User Authentication**: Secure login and registration system.
- **CRUD Operations**: Create, read, update, and delete blog posts.
- **Rich Text Editor**: Easy-to-use editor for formatting blog content.
- **Responsive Design**: Optimized for both desktop and mobile devices.
- **Category Management**: Organize posts into categories for better navigation.

## Installation

### Prerequisites

Ensure you have the following installed:

- PHP (>= 8.0)
- Composer
- Laravel Installer
- Node.js and npm (for frontend assets)

### Steps

1. Clone the repository and install dependencies:

   ```bash
   git clone https://github.com/khademul-menaliam/Blog_Post_Web_App.git
   cd Blog_Post_Web_App
   composer install
   cp .env.example .env
   php artisan key:generate
   ```

2. Configure your database and update the `.env` file accordingly.

3. Run migrations and install frontend dependencies:

   ```bash
   php artisan migrate
   npm install
   npm run dev
   ```

4. Serve the application locally:

   ```bash
   php artisan serve
   ```

Open your browser and visit `http://localhost:8000` to see the application running.

## Usage

- Access the admin panel to manage blog posts and categories.
- Users can browse, read, and interact with published blog posts.

## Deployment

For deployment instructions, please refer to the [deployment guide](deployment/).

## Contributing

Contributions are welcome! Please fork the repository and submit pull requests for review.

## License

This project is licensed under the MIT License.
