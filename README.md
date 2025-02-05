Below is a **README.md** file for your Task Management System project. This file provides instructions for setting up the project, running migrations, seeding the database, and testing the API using Postman.

---

# Task Management System

This is a RESTful API for a Task Management System built with Laravel. It allows users to create tasks, assign dependencies, and manage task statuses. The system includes role-based access control (RBAC) to ensure that only authorized users can perform specific actions.

---

## **Features**
- **User Authentication**: Login and logout using JWT tokens.
- **Role-Based Access Control**:
  - **Managers**: Can create/update tasks and assign tasks to users.
  - **Users**: Can view tasks assigned to them and update task status.
- **Task Management**:
  - Create, update, and delete tasks.
  - Add dependencies between tasks.
  - Prevent circular dependencies.
  - Retrieve task details with dependencies.
- **Database Seeding**: Pre-populated with roles, users, and sample tasks.

---

## **Technologies Used**
- **Backend**: Laravel 11
- **Database**: MySQL
- **Authentication**: Laravel sanctum
- **Testing**: Postman

---

## **Setup Instructions**

### **1. Clone the Repository**
```bash
git clone <repository_link>
cd Path
```

### **2. Install Dependencies**
```bash
composer install
```

### **3. Set Up Environment File**
1. Copy the `.env.example` file to `.env`:
   ```bash
   cp .env.example .env
   ```
2. Generate the application key:
   ```bash
   php artisan key:generate
   ```
3. Update the `.env` file with your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=task_management
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

### **4. Run Migrations and Seed the Database**
```bash
php artisan migrate
php artisan db:seed
```

### **5. serve project**
```bash
php artisan serve
```

---

## **API Testing with Postman**

### **1. Import Postman Collection**
1. Open Postman.
2. Click on **Import** and select the `task-management.postman_collection.json` file.

### **2. Login as Manager**
- Use the following credentials to log in as a **Manager**:
  - **Email**: `admin@admin.com`
  - **Password**: `12345678`
- Use the **Login** endpoint to get a JWT token.

### **3. Login as User**
- Use the **Get Users** endpoint to retrieve a list of users.
- Use any user's email and the password `12345678` to log in as a **User**.

### **4. Test Endpoints**
- **Tasks**:
  - Create a new task.
  - Add dependencies to a task (circular dependencies are prevented).
  - Retrieve task details with dependencies.
  - Update task status.
- **Users**:
  - Retrieve a list of users.
  - View tasks assigned to a specific user.

---

## **API Endpoints**

### **Authentication**
- **POST /api/login**: Log in and get a JWT token.
- **POST /api/logout**: Log out and invalidate the JWT token.

### **Tasks**
- **POST /api/tasks**: Create a new task (Manager only).
- **GET /api/tasks**: Retrieve a list of tasks (filter by status, due date, or assignee).
- **GET /api/tasks/{id}**: Retrieve details of a specific task including dependencies.
- **PUT /api/tasks/{id}**: Update task details (Manager only).
- **PATCH /api/tasks/{id}/complete**: Update task status (User only).
- **POST /api/tasks/{id}/dependencies**: Add a dependency to a task (Manager only).

### **Users**
- **GET /api/users**: Retrieve a list of users (Manager only).

---

## **Database Schema**

### **Tables**
- **users**: Stores user details.
- **roles**: Defines user roles (Manager, User).
- **tasks**: Stores task details.
- **task_dependencies**: Stores dependencies between tasks.

### **Relationships**
- A **user** belongs to a **role**.
- A **task** is assigned to a **user**.
- A **task** can have multiple **dependencies**.

---

## **Prevent Circular Dependencies**
When adding a dependency to a task, the system checks for circular dependencies to prevent infinite loops. If a circular dependency is detected, an error is returned.

---

## **Seed Data**
The database is seeded with the following data:
- **Roles**: Manager, User.
- **Users**:
  - Manager: `admin@admin.com` (password: `12345678`).
  - Users: Randomly generated users (password: `12345678`).
- **Tasks**: Sample tasks with dependencies.

---


