<?php

$palette = $GLOBALS['TL_DCA']['tl_settings']['palettes'];
$palette = isset($palette['default']) ? $palette['default'] : $palette;

$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] = str_replace('{files_legend', '{recaptcha_legend},recaptchaType,recaptchaPublicKey,recaptchaPrivateKey;{files_legend', $palette);
$GLOBALS['TL_DCA']['tl_settings']['palettes']['recaptcha3'] = str_replace('{files_legend', '{recaptcha_legend},recaptchaType,recaptcha3GlobalThreshold,recaptchaPublicKey,recaptchaPrivateKey;{files_legend', $palette);

$GLOBALS['TL_DCA']['tl_settings']['palettes']['__selector__'][] = 'recaptchaType';


$GLOBALS['TL_DCA']['tl_settings']['fields'] += [
    'recaptchaType' => [
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
        'eval'              => ['tl_class' => 'w50', 'chosen' => true, 'submitOnChange' => true],
    ],
    'recaptchaPublicKey' => [
        'label'             => &$GLOBALS['TL_LANG']['tl_settings']['recaptchaPublicKey'],
        'inputType'         => 'text',
        'eval'              => ['tl_class' => 'w50 clr'],
    ],
    'recaptchaPrivateKey' => [
        'label'             => &$GLOBALS['TL_LANG']['tl_settings']['recaptchaPrivateKey'],
        'inputType'         => 'text',
        'eval'              => ['tl_class' => 'w50'],
    ],
    'recaptcha3GlobalThreshold' => [
        'label'             => &$GLOBALS['TL_LANG']['tl_settings']['recaptcha3GlobalThreshold'],
        'inputType'         => 'text',
        'default'           => '0.5',
        'eval'              => ['tl_class' => 'w50'],
    ],
];
