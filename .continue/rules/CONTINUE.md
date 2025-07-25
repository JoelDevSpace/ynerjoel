# Project Guide for Laravel Vue Starter Kit

## Project Overview

This project is a Laravel-based web application with a Vue.js frontend. It serves as a starter kit for building modern web applications with Laravel and Vue.

### Key Technologies

- **Backend**: Laravel (PHP)
- **Frontend**: Vue.js
- **Build Tool**: Vite
- **CSS Framework**: Tailwind CSS
- **State Management**: Vue 3 Composition API
- **Routing**: Inertia.js

### High-Level Architecture

The project follows a typical Laravel application structure with additional Vue.js components for the frontend. The backend handles API requests and business logic, while the frontend manages the user interface and interactions.

## Getting Started

### Prerequisites

- PHP 8.2 or higher
- Node.js 14 or higher
- Composer
- npm or yarn

### Installation Instructions

1. **Clone the repository**
    ```sh
    git clone https://github.com/your-repo/laravel-vue-starter-kit.git
    cd laravel-vue-starter-kit
    ```

2. **Install PHP dependencies**
    ```sh
    composer install
    ```

3. **Install Node.js dependencies**
    ```sh
    npm install
    ```

4. **Set up environment variables**
    ```sh
    cp .env.example .env
    php artisan key:generate
    ```

5. **Run database migrations**
    ```sh
    php artisan migrate
    ```

6. **Start the development server**
    ```sh
    npm run dev
    ```

### Basic Usage Examples

- **Running the development server**
    ```sh
    npm run dev
    ```

- **Building for production**
    ```sh
    npm run build
    ```

### Running Tests

- **Run PHPUnit tests**
    ```sh
    php artisan test
    ```

- **Run Pest tests**
    ```sh
    ./vendor/bin/pest
    ```

## Project Structure

### Main Directories

- **app/**: Contains the Laravel application code.
- **resources/**: Contains frontend assets (CSS, JavaScript, Vue components).
- **routes/**: Contains route definitions.
- **tests/**: Contains test cases.

### Key Files

- **composer.json**: Defines PHP dependencies and scripts.
- **package.json**: Defines Node.js dependencies and scripts.
- **vite.config.ts**: Configuration for Vite build tool.
- **resources/js/app.ts**: Entry point for the Vue.js application.

### Important Configuration Files

- **.env**: Environment variables.
- **config/**: Laravel configuration files.
- **tailwind.config.js**: Tailwind CSS configuration.

## Development Workflow

### Coding Standards

- Follow PSR-12 for PHP code.
- Use Vue 3 Composition API for Vue components.
- Use TypeScript for type safety.

### Testing Approach

- Write unit tests using PHPUnit.
- Write integration tests using Pest.

### Build and Deployment Process

- Use Vite for building the frontend.
- Use Laravel Mix for compiling assets.
- Deploy using Laravel Forge or similar services.

### Contribution Guidelines

- Fork the repository.
- Create a new branch for your feature or bug fix.
- Submit a pull request with a clear description of your changes.

## Key Concepts

### Domain-Specific Terminology

- **Inertia.js**: A modern monolithic framework for building single-page applications.
- **Vue 3 Composition API**: A new way to organize and reuse code in Vue 3.

### Core Abstractions

- **Components**: Reusable Vue components.
- **Composables**: Reusable logic encapsulated in functions.

### Design Patterns Used

- **Service Layer**: Separates business logic from controllers.
- **Repository Pattern**: Abstracts data access logic.

## Common Tasks

### Step-by-Step Guides

- **Creating a new Vue component**
    1. Create a new file in `resources/js/components`.
    2. Define the component using Vue 3 Composition API.
    3. Import and use the component in a Vue page.

- **Adding a new route**
    1. Define the route in `routes/web.php`.
    2. Create a corresponding controller method.
    3. Create a Vue page for the route.

### Examples of Common Operations

- **Fetching data from an API**
    ```javascript
    import { ref, onMounted } from 'vue';
    import axios from 'axios';

    const data = ref(null);

    onMounted(async () => {
        const response = await axios.get('/api/data');
        data.value = response.data;
    });
    ```

## Troubleshooting

### Common Issues

- **404 Not Found**: Ensure the route is defined correctly in `routes/web.php`.
- **Vue component not rendering**: Check if the component is imported and used correctly.

### Debugging Tips

- Use browser developer tools to inspect network requests and component state.
- Use Laravel's logging features to debug server-side issues.

## References

### Links to Relevant Documentation

- [Laravel Documentation](https://laravel.com/docs)
- [Vue.js Documentation](https://vuejs.org/guide/introduction.html)
- [Vite Documentation](https://vitejs.dev/guide/)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)

### Important Resources

- [Laracasts](https://laracasts.com/)
- [Vue Mastery](https://www.vuemastery.com/)

This guide provides a comprehensive overview of the project, helping developers get started quickly and understand the key aspects of the codebase. Review and edit this file as needed to ensure it meets your project's specific requirements.