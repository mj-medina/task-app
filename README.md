# task-app
A Simple task app made with Laravel and Nuxt.

## Setup

1. Clone this repository: https://github.com/mj-medina/task-app.git
2. Create a MySQL database and name it `task` (You can adjust the database name in `.env` file).
Note: Create .env file. (Copy .env.example)

3. **Backend Setup**

- Open your terminal and navigate to the backend directory:
  ```
  cd backend
  ```

- Install PHP dependencies:
  ```
  composer install
  ```

- Generate the application key:
  ```
  php artisan key:generate
  ```

- Run database migrations to create tables:
  ```
  php artisan migrate
  ```

- Start the Laravel development server:
  ```
  php artisan serve
  ```

The backend API will be accessible at `http://localhost:8000`.

4. **Frontend Setup**

- Open your terminal and navigate to the frontend directory:
  ```
  cd frontend
  ```

- Install Node.js dependencies:
  ```
  npm install
  ```

- Build the frontend assets:
  ```
  npm run dev
  ```

## Environment Configuration

Add the following line to backend `.env` file to configure Sanctum for stateful domains:
```
SANCTUM_STATEFUL_DOMAINS=localhost,localhost:3000
APP_URL=http://localhost:8000
SESSION_DOMAIN=localhost
```

You can now access the web application by opening it in your web browser.

## Usage

- Visit `http://localhost:3000` to use the Task Management App.


