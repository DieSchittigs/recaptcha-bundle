<?php

// Extend the default palette
Contao\CoreBundle\DataContainer\PaletteManipulator::create()
    ->addLegend('recaptcha_legend', 'files_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_AFTER)
    ->addField(['recaptchaType', 'recaptchaPublicKey', 'recaptchaPrivateKey'], 'recaptcha_legend', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_APPEND)
    ->applyToPalette('default', 'tl_settings');

if (Contao\Config::get('recaptchaType') === 'recaptcha3')
{
    // Add additional field if Contao\Config::get('recaptchaType') === 'recaptcha3'
    Contao\CoreBundle\DataContainer\PaletteManipulator::create()
        ->addField(['recaptcha3GlobalThreshold'], 'recaptchaType', Contao\CoreBundle\DataContainer\PaletteManipulator::POSITION_AFTER)
        ->applyToPalette('default', 'tl_settings');
}


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_settings']['fields'] += [
    'recaptchaType'             => [
        'label'            => &$GLOBALS['TL_LANG']['tl_settings']['recaptchaType'],
        'inputType'        => 'select',
        'options_callback' => function () {
            return [
                'invisible'  => 'reCAPTCHA v2: Invisible',
                'recaptcha2' => 'reCAPTCHA v2: Checkbox',
                'recaptcha3' => 'reCAPTCHA v3',
            ];
        },
        'eval'             => ['tl_class' => 'w50', 'chosen' => true, 'submitOnChange' => true],
    ],
    'recaptchaPublicKey'        => [
        'label'     => &$GLOBALS['TL_LANG']['tl_settings']['recaptchaPublicKey'],
        'inputType' => 'text',
        'eval'      => ['tl_class' => 'w50 clr'],
    ],
    'recaptchaPrivateKey'       => [
        'label'     => &$GLOBALS['TL_LANG']['tl_settings']['recaptchaPrivateKey'],
        'inputType' => 'text',
        'eval'      => ['tl_class' => 'w50'],
    ],
    'recaptcha3GlobalThreshold' => [
        'label'     => &$GLOBALS['TL_LANG']['tl_settings']['recaptcha3GlobalThreshold'],
        'inputType' => 'text',
        'default'   => '0.5',
        'eval'      => ['tl_class' => 'w50'],
    ],
];
