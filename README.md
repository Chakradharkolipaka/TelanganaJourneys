# Booking System - Telangana Journey's

This project provides a simple PHP-based booking system for the Telangana Journey's website. It allows users to submit booking requests, which are then stored in a MySQL database.

## Features

- Accepts booking details via an HTML form (fields: Name, Persons, Email, Number, Aadhar Number, Address, Pickup, Places).
- Stores booking information securely in a MySQL database using prepared statements (PDO).
- Displays a confirmation alert and redirects users to the homepage after successful booking.
- Handles database connection errors gracefully.

## File Structure

- `Pages-inside/booking.php` - Main backend script for processing booking form submissions.
- `Pages-inside/HomePage.html` - Homepage to which users are redirected after booking.
- `tour` - MySQL database (see below for table structure).

## Prerequisites

- PHP 7.x or above
- MySQL server
- Web server (e.g., Apache, XAMPP)
- The `tour` database and `booking` table must exist.

## Database Setup

1. **Create the Database:**

   ```sql
   CREATE DATABASE tour;
   ```

2. **Create the Booking Table:**

   ```sql
   USE tour;

   CREATE TABLE booking (
     id INT AUTO_INCREMENT PRIMARY KEY,
     Name VARCHAR(255) NOT NULL,
     Persons INT NOT NULL,
     Email VARCHAR(255) NOT NULL,
     Number VARCHAR(20) NOT NULL,
     ANumber VARCHAR(20) NOT NULL,
     Address VARCHAR(255) NOT NULL,
     Pickup VARCHAR(255) NOT NULL,
     Places TEXT NOT NULL,
     created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
   );
   ```

## How It Works

1. **Form Submission:**
   - The user fills out a booking form (not included here, but should POST to `booking.php`).
   - The form fields should be named: `name`, `persons`, `email`, `number`, `aNumber`, `address`, `pickup`, `places`.

2. **Processing:**
   - `booking.php` receives the POST request.
   - Connects to the MySQL database using both MySQLi and PDO (PDO is used for the actual insert).
   - Validates and sanitizes input.
   - Inserts the booking data into the `booking` table using a prepared statement.
   - Shows a JavaScript alert and redirects to `HomePage.html`.

## Example Booking Form

```html
<form action="booking.php" method="POST">
  <input type="text" name="name" placeholder="Name" required>
  <input type="number" name="persons" placeholder="Number of Persons" required>
  <input type="email" name="email" placeholder="Email" required>
  <input type="text" name="number" placeholder="Phone Number" required>
  <input type="text" name="aNumber" placeholder="Aadhar Number" required>
  <input type="text" name="address" placeholder="Address" required>
  <input type="text" name="pickup" placeholder="Pickup Location" required>
  <textarea name="places" placeholder="Places to Visit" required></textarea>
  <button type="submit">Book Now</button>
</form>
```

## Security Notes

- All database operations use prepared statements to prevent SQL injection.
- Input validation is minimal; consider adding more robust validation and sanitization.
- Passwords and sensitive data should always be handled securely (not relevant for booking, but important for user systems).

## Customization

- To change the redirect page, modify the `window.location.href` in the JavaScript alert in `booking.php`.
- To add more fields, update both the HTML form and the PHP script/database table accordingly.

## Troubleshooting

- **Database Connection Errors:** Ensure MySQL is running and credentials in `booking.php` are correct.
- **No Data Inserted:** Check that the form fields match the expected POST variable names.
- **Page Not Redirecting:** Ensure JavaScript is enabled in the browser.

## License

This project is for educational/demo purposes. Adapt as needed for your use case.

---

**Author:** Telangana Journey's Project Team
