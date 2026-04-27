# Tasca S1.07: Exceptions and Validation

This repository contains the resolution for the **S1.07** module, focusing on implementing robust error handling and data validation.

## Project Overview

The goal of this project is to create a secure login/registration simulation that validates user input (Username, Password, Language, and Mode) and handles invalid data through custom exception classes rather than simple error strings.

## Level 2 Implementation: Custom Exceptions

In this level, the focus shifted from basic validation to a structured exception-handling architecture.

### Key Features:
- **Strict Typing**: Enabled `declare(strict_types=1);` across PHP files to ensure data integrity.
- **Custom Exception Classes**:
    - `InvalidUsernameException`: Triggered if the username does not meet length or character requirements.
    - `InvalidPasswordException`: Triggered for missing uppercase letters, special characters, or incorrect length.
    - `InvalidLanguageException` & `InvalidModeException`: Enforce strict selection from predefined options.
- **Try-Catch Architecture**: The logic is wrapped in a `try-catch` block that captures specific exceptions and displays user-friendly error messages without breaking the execution flow.
- **State Persistence**: The frontend uses `URLSearchParams` to repopulate the form fields if a validation error occurs, improving the User Experience (UX).

## File Structure
- `index.html`: The frontend form with logic to recover data from the URL.
- `index.php`: The backend processing engine where exceptions are defined and handled.
- `style.css`: Microsoft-inspired UI styling with responsive design support.

## ⚙️ Requirements
- PHP 8.0 or higher.
- A local server environment like XAMPP.
