<?php

use DieSchittigs\RecaptchaBundle\Form\FormRecaptcha;

$GLOBALS['TL_FFL']['captcha'] = FormRecaptcha::class;
$GLOBALS['TL_HOOKS']['addCustomRegexp'][] = [Contao\RecaptchaHooks::class, 'addRecaptchaActionRegexp'];

array_insert($GLOBALS['TL_CTE']['miscellaneous'], 0, [
    'backgroundrecaptcha' => Contao\ContentBackgroundRecaptcha::class,
]);
