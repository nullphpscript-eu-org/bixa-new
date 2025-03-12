<div align="center">
    <img src="assets/default/images/Nullphpscript.png" width="250px">
</div>

> **Note:**  
> **This development of this build is live again.**
> A bugfix release is coming due the currently known errors.
> Pull requests are welcome and will still be accepted. If you want to see a feature, feel free to contribute it.
> Thanks to @greenreader9 for answering people's questions and solving their issues while i was gone.

## 👀 What is Bixa?

Bixa is a hosting account and support management system especially designed to work with MOFH (MyOwnFreeHost). Bixa currently has a limited number of features which are listed below:

[![AppVeyor](https://img.shields.io/badge/Licence-GPL_2.0-orange)](LICENSE)
[![AppVeyor](https://img.shields.io/badge/Version-v1.2.8-informational)](https://github.com/bixacloud/bixa/releases/latest)
![AppVeyor](https://img.shields.io/badge/Build-Passed-brightgreen)
![AppVeyor](https://img.shields.io/badge/Interface-Tabler-lightgreen)
![AppVeyor](https://img.shields.io/badge/Development-Live-brightgreen)
![AppVeyor](https://img.shields.io/badge/Dependencies-PHP,_MySQL,_cUrl-red)

### 🎮 Features

- User Management
- Theme Management
- Support Management
- Administrative Access
- Integrates With:
  - MOFH (MyOwnFreeHost)
  - Google reCAPTCHA
  - hCaptcha
  - Cloudflare Turnstile
  - GoGetSSL
  - ACMEv2 (Let's Encrypt, ZeroSSL and Google Trust)
  - Site.Pro
  - SMTP
- Update Manager
- Multi-lingual

## 🤸 Getting Started

### 🚅 Requirements

Your server needs to meet the following minimum requirements to run Bixa:

- PHP v8.1 or above.
- MySQL v5.7 or above.
- A valid, trusted SSL certificate.

### 💾 Installation

The installation of Bixa is much easier than you think!

- Download the Bixa installation files [here](https://github.com/nullphpscript-eu-org/bixa-new/archive/refs/heads/main.zip).
- Extract the ZIP file and upload the contents to your web hosting account.
- Create a new database for Bixa.
- Go to `https://{your.domain}/{bixa-directory}/install.php` and click on the 'Get Started' button.
- Set your website's `Website URL`, `Cookie Prefix`, enable `CSRF Protection` and hit the 'Next Step' button.
- Edit the database credentials and click on the 'Next Step' button (this will automatically import tables and records to the database).
- Register an admin account and log in to your admin panel.
- Replace the logo and favicon located in `assets/default/img/` with your own.
- Setup SMTP (see below for some services you can use).

### 📧 SMTP

Here are some widely used SMTP services. They all have free plans with some limitations, and are compatible with Bixa.

#### Production Environment

Information shown below was last updated in December 2024 and may not be accurate.

- [Mailtrap](https://mailtrap.io/):
  - Email Testing Environment (500 emails/month free)
  - Production SMTP Service (1,000 emails/month free)
  - Good for both development and production
  - Includes email testing and debugging features
- [Mailjet](https://mailjet.com/):
  - Production SMTP Service (6,000 emails/month free)
- [SendGrid](https://sendgrid.com/free/):
  - Production SMTP Service (1000 emails/day free)

### 🤔 Help

You can [open an issue here](https://github.com/bixacloud/bixa/issues/new) if you have discovered a bug or have an issue. Please ensure your topic has not been previously discussed, if it has, please contribute to that discussion instead of creating a new one if possible.

Join our Telegram group at [Nullphpscript](https://t.me/NullphpscriptEuOrg) for discussions, bug reports, and community support. Please note that English is the primary language for communication.

### 👍 Like Bixa?

If you like project Bixa please donate [here]().

## ©️ Copyright

Code released under [the GPL-2.0 license](LICENSE).
