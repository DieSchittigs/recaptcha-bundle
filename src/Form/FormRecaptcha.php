<?php

namespace DieSchittigs\RecaptchaBundle\Form;

use Contao\FormCaptcha;
use Contao\Config;

class FormRecaptcha extends FormCaptcha
{
    protected $strTemplate = 'form_recaptcha';

    protected $recaptchaType = 'invisible';

    protected $publicKey = null;

    protected $privateKey = null;

    public function __construct($arrAttributes = null)
    {
        parent::__construct($arrAttributes);

        $this->recaptchaType  = Config::get('recaptchaType'); 
        $this->publicKey  = Config::get('recaptchaPublicKey'); 
        $this->privateKey = Config::get('recaptchaPrivateKey');

        if ($this->useFallback()) {
            $this->strTemplate = 'form_captcha';
        }
    }

    protected function useFallback()
    {
        return !$this->publicKey || !$this->privateKey;
    }

    public function validate()
    {
        if ($this->useFallback()) return parent::validate();
        
        try {
            $response = $_POST['g-recaptcha-response'] ?? false;
            if ($response === false) throw new \Exception;

            $curl = curl_init('https://www.google.com/recaptcha/api/siteverify');

            curl_setopt($curl, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query([
                'secret' => $this->privateKey,
                'response' => $response,
                'remoteip' => $_SERVER['REMOTE_ADDR'],
            ]));
            
            $response = curl_exec($curl);
            if ($response === false) throw new \Exception; // Request error

            $parsed = json_decode($response, true);
            if (!$parsed['success']) {
                if (in_array('invalid-input-secret', $parsed['error-codes'])) {
                    \System::log('Google reCAPTCHA private key is invalid.', __METHOD__, TL_CONFIGURATION);
                }

                throw new \Exception;
            }
        } catch (\Exception $e) {
            $this->class = 'error';
            $this->addError($GLOBALS['TL_LANG']['ERR']['recaptcha']);
        }
    }
}
