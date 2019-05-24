<?php

namespace DieSchittigs\RecaptchaBundle\Form;

use Contao\FormCaptcha;
use Contao\Config;
use Contao\FormModel;

class FormRecaptcha extends FormCaptcha
{
    protected $strTemplate = 'form_recaptcha';

    protected $recaptchaType = 'invisible';

    protected $publicKey = null;

    protected $privateKey = null;

    public function __construct($arrAttributes = null)
    {
        parent::__construct($arrAttributes);

        $this->recaptchaType = Config::get('recaptchaType'); 
        $this->publicKey = Config::get('recaptchaPublicKey'); 
        $this->privateKey = Config::get('recaptchaPrivateKey');
        $this->globalThreshold = Config::get('recaptcha3GlobalThreshold');

        if ($this->recaptcha3_action) {
            $this->recaptchaAction = $this->recaptcha3_action;
        } elseif ($this->recaptchaType == 'recaptcha3') {
            $form = FormModel::findById($this->pid);
            $this->recaptchaAction = $form->alias;
        }

        $this->recaptchaAction = str_replace('-', '_', $this->recaptchaAction);
        $this->recaptchaAction = preg_replace('/[^a-zA-Z\/_]/', '', $this->recaptchaAction);

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
            $response = isset($_POST['g-recaptcha-response']) ? $_POST['g-recaptcha-response'] : false;
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

            if ($this->recaptchaType === 'recaptcha3') {
                $score = $parsed['score'];

                // Use this field's threshold, otherwise use the default
                $threshold = $this->recaptcha3_threshold ? $this->recaptcha3_threshold : $this->globalThreshold;
                if (!$threshold) $threshold = 0;

                if ($parsed['action'] && $parsed['action'] != $this->recaptchaAction) {
                    throw new \Exception;
                }
                
                if ($score < $threshold) {
                    throw new \Exception;
                }
            }
        } catch (\Exception $e) {
            $this->class = 'error';
            $this->addError($GLOBALS['TL_LANG']['ERR']['recaptcha']);
        }
    }
}
