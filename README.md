# ⛔ Unmaintained ⛔
This bundle has not been maintained for some time and should no longer be used.

## Contao reCAPTCHA Integration
A Contao 4 Bundle that replaces Contao's default captcha with the more robust [Google reCAPTCHA](https://www.google.com/recaptcha/intro/v3.html).

We support the following captchas:
- reCAPTCHA v2 Checkbox
- reCAPTCHA v2 Invisible
- reCAPTCHA v3

### Installation
Either require `dieschittigs/contao-recaptcha` via composer or install the bundle from your Contao Manager. Afterwards you will need to update your database as this bundle adds new fields to some tables.

### Configuration
You can configure the reCAPTCHA type and keys in the Contao system settings.

#### reCAPTCHA v3
reCAPTCHA v3 is more convenient for the end user, but it's also a little more complicated to set up. In addition to configuring your reCAPTCHA keys you will have to set up a global threshold and optionally an individual threshold on a per-form basis.

> reCAPTCHA v3 returns a score (1.0 is very likely a good interaction, 0.0 is very likely a bot). Based on the score, you can take variable action in the context of your site.  
> [...]  
> reCAPTCHA learns by seeing real traffic on your site. For this reason, scores in a staging environment or soon after implementing may differ from production. As reCAPTCHA v3 doesn't ever interrupt the user flow, you can first run reCAPTCHA without taking action and then decide on thresholds by looking at your traffic in the [admin console](https://g.co/recaptcha/admin). By default, you can use a threshold of 0.5.  

(https://developers.google.com/recaptcha/docs/v3#score)

When adding a new captcha form input you will notice an additional textbox for the reCAPTCHA v3 threshold. You can enter a custom threshold that will override the global threshold for this form only. For example you may want to use a higher threshold for password resets than for contact forms.

##### Actions
reCAPTCHA v3 allows you to run the recaptcha code wherever you want with custom action names. This gives you more in-depth information about the scores of users on your page which you can use to fine-tune the threshold. It also allows Google to do better analysis and give more accurate results. If you want to use this feature, you can include the new content element "_Background reCAPTCHA v3_" on individual pages.

#### Fallback
If either the private or public key is left empty, the captcha falls back to the default Contao captcha. 

We do not perform any additional validation of the keys. If the public key is incorrect, Google will tell you when rendering the captcha. If the private key is invalid, all captcha responses are invalidated and the bundle will notice you via the Contao system log.

#### CSS
This package is rather unopinionated, so it doesn't provide any CSS. When using Invisible reCAPTCHA Google wants you to display a message on the page to let the user know the form is protected by reCAPTCHA. Google's Javascript already renders this message, but depending on your page layout it could be rendered behind other elements. Therefore it might be necessary to up the `z-index` for the CSS class `grecaptcha-badge`.
