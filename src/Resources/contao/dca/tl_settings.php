<?php

$GLOBALS['TL_DCA']['tl_settings']['fields']['recaptchaType'] = [
    'label'             => &$GLOBALS['TL_LANG']['tl_settings']['recaptchaType'],
    'inputType'         => 'select',
    'options_callback'  => function () 
    {
        return [
            'invisible' => 'Invisible reCAPTCHA', 
            'recaptcha2' => 'reCAPTCHA v2'
        ];
    },
    'eval'              => ['chosen' => true]
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['recaptchaPublicKey'] = [
    'label'             => &$GLOBALS['TL_LANG']['tl_settings']['recaptchaPublicKey'],
    'inputType'         => 'text',
    'eval'              => ['tl_class' => 'w50']
];

$GLOBALS['TL_DCA']['tl_settings']['fields']['recaptchaPrivateKey'] = [
    'label'             => &$GLOBALS['TL_LANG']['tl_settings']['recaptchaPrivateKey'],
    'inputType'         => 'text',
    'eval'              => ['tl_class' => 'w50']
];

$GLOBALS['TL_DCA']['tl_settings']['palettes'] = str_replace('{files_legend', '{recaptcha_legend},recaptchaType,recaptchaPublicKey,recaptchaPrivateKey;{files_legend', $GLOBALS['TL_DCA']['tl_settings']['palettes']);
