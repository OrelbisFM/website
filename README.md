**Orelbis' Games** is a simple PHP + MySQL website project.
## Contains
- **Product catalog** - browsable grid of games with prices (`index.php`, `products.php`)
- **User accounts** - registration, login, logout (`register.php`, `login.php`, `logout.php`)
- **Profile management** - update username, password, phone, email, and age (`profile.php`, `update_profile.php`)
- **Shared layout** - common header/footer includes and a single stylesheet (`header.php`, `footer.php`, `css/style.css`)

## Structure

```
.
├── index.php            # Home page, featured games
├── products.php         # Full catalog
├── about.php            # About
├── register.php         # New account registration
├── login.php            # User login
├── logout.php           # Destroys session, redirects to login
├── profile.php           # View/edit account details
├── update_profile.php   # Handles profile update form submission
├── checkout.php         # Shipping/order details form
├── config.php           # DB connection + session_start()
├── header.php           # Shared site header/nav
├── footer.php           # Shared site footer
├── css/
│   └── style.css        # Stylesheet
└── assets/
    ├──
```

## Database

Expects a `users` table shaped like:

```sql
CREATE TABLE users (
    id       INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50)  NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    phone    VARCHAR(10)  NOT NULL,
    email    VARCHAR(100) NOT NULL UNIQUE,
    age      INT          NOT NULL
);
```

Passwords are stored using PHP's `password_hash()`

## Setup

1. **Clone the repo** and place the files on a PHP enabled web server or host.
2. **Create the database** using the schema above.
3. **Configure the connection** in `config.php`
