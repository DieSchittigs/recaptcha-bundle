<?php

namespace Contao;

class RecaptchaHooks
{
    public function addRecaptchaActionRegexp($regexpName, $value, Widget $widget)
    {
        if ($regexpName !== 'recaptcha') return false;

        if (preg_match('/[^a-zA-Z\/_]/', $value) !== 0) {
            $widget->addError($GLOBALS['TL_LANG']['ERR']['recaptcha_rgxp']);
        }
        
        return true;
    }
}