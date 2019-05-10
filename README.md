## Contao reCAPTCHA Integration
A Contao 4 Bundle that replaces Contao's default captcha with the more robust [Google reCAPTCHA](https://www.google.com/recaptcha/intro/v3.html).

We support the following captchas:
- reCAPTCHA v2 Checkbox
- reCAPTCHA v2 Invisible
- reCAPTCHA v3 (currently work in progress)

### Installation
Either require `dieschittigs/contao-recaptcha` via composer or install the bundle from your Contao Manager.

Configure your private and public key in the system settings.

#### Fallback
If either the private or public key is left empty, the captcha falls back to the default Contao captcha. 

We do not perform any additional validation of the keys. If the public key is incorrect, Google will tell you when rendering the captcha. If the private key is invalid, all captcha responses are invalidated and the bundle will notice you via the Contao system log.

#### CSS
This package is rather unopinionated, so it doesn't provide any CSS. When using Invisible reCAPTCHA Google wants you to display a message on the page to let the user know the form is protected by reCAPTCHA. Google's Javascript already renders this message, but depending on your page layout it could be rendered behind other elements. Therefore it might be necessary to up the `z-index` for the CSS class `grecaptcha-badge`.

