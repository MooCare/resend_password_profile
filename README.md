# Resend Confirmation Email – Moodle Plugin

This Moodle plugin allows site administrators to **resend the account confirmation email** to a user directly from their profile page. It's useful in cases where users did not receive the initial email or accidentally deleted it.

## 🧩 Plugin Type

**Local plugin**  
Directory name: `local_resend_password_profile`

## ✅ Features

- Adds a new action in the user profile page for admins
- Resends the default account confirmation email
- Only available for users who haven't confirmed their account yet
- Simple and lightweight

## 📂 Installation

1. Download or clone this repository into the `local/` directory of your Moodle installation:
    ```bash
    git clone https://github.com/moocare/local_resend_password_profile local/resend_password_profile
    ```

2. Go to **Site administration > Notifications** to complete the installation.

3. No additional configuration is needed.

## 📸 Screenshots

*(Optional: Add screenshots here of the plugin in action)*

## 🛠 Requirements

- Moodle 4.0 or higher
- Admin access to the site

## 🚫 Permissions

Only users with the capability `moodle/user:update` (usually site admins) will see the option to resend the confirmation email.

## 🔒 Security

This plugin includes basic checks to ensure that:

- Only unconfirmed users are eligible
- Only admins can perform the action

## 🌍 Languages

Currently available in:

- English (en)
- French (fr)

Feel free to contribute translations!

## 🧑‍💻 Contributing

Pull requests are welcome. If you find a bug or want to propose an improvement, please open an issue or submit a PR.

## 📄 License

This plugin is licensed under the [GNU General Public License v3.0](https://www.gnu.org/licenses/gpl-3.0.html).

## 📬 Contact

Developed by: MooCare  
GitHub: [https://github.com/moocare](https://github.com/moocare)  
