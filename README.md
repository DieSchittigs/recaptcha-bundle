## Contao reCAPTCHA Integration

#### Fallback
If either the private or public key is left empty, the captcha falls back to the default Contao captcha. 

We do not perform any additional validation of the keys. If the public key is incorrect, Google will tell you when rendering the captcha. If the private key is invalid, all captcha responses are invalidated and the bundle will notice you via the Contao system log.
