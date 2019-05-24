<?php

namespace Contao;

class ContentBackgroundRecaptcha extends ContentElement
{
    protected $strTemplate = 'ce_background_recaptcha';

    protected function compile()
    {
        if (TL_MODE == 'BE') {
            $this->generateBackendOutput();
        } else {
            $this->generateFrontendOutput();
        }
    }

    protected function generateBackendOutput()
    {
        $this->strTemplate          = 'be_wildcard';
        $this->Template             = new BackendTemplate($this->strTemplate);

        if (Config::get('recaptchaType') == 'recaptcha3') {
            $actionString = $GLOBALS['TL_LANG']['tl_content']['recaptcha_action'][0];
            $this->Template->wildcard = '<strong>' . $actionString . ':</strong> ' . $this->recaptcha_action;
        } else {
            $this->Template->wildcard = '<span style="color:red;">' . $GLOBALS['TL_LANG']['tl_content']['recaptcha_wrong_type'] . '</span>';
        }
    }

    protected function generateFrontendOutput()
    {
        $this->Template->id = $this->id;
        $this->Template->recaptchaType = Config::get('recaptchaType');
        $this->Template->publicKey  = Config::get('recaptchaPublicKey'); 
        $this->Template->action = $this->recaptcha_action; 
    }
}
