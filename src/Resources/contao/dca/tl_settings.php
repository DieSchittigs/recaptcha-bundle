<?php

$GLOBALS['TL_DCA']['tl_settings']['fields']['recaptchaType'] = [
    'label'             => &$GLOBALS['TL_LANG']['tl_settings']['recaptchaType'],
    'inputType'         => 'select',
    'options_callback'  => function () 
    {
        return [
            'invisible' => 'reCAPTCHA v2: Invisible', 
            'recaptcha2' => 'reCAPTCHA v2: Checkbox', 
            'recaptcha3' => 'reCAPTCHA v3',
        ];
    },
    'eval'              => ['chosen' => true, 'submitOnChange' => true]
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

$GLOBALS['TL_DCA']['tl_settings']['fields']['recaptcha3GlobalThreshold'] = [
    'label'             => &$GLOBALS['TL_LANG']['tl_settings']['recaptcha3GlobalThreshold'],
    'inputType'         => 'text',
    'default'           => '0.5',
    'eval'              => ['tl_class' => 'w50']
];

$GLOBALS['TL_DCA']['tl_settings']['palettes'] = str_replace('{files_legend', '{recaptcha_legend},recaptchaType,recaptchaPublicKey,recaptchaPrivateKey;{files_legend', $GLOBALS['TL_DCA']['tl_settings']['palettes']);
