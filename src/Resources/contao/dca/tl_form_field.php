<?php

// alter palette for use with reCaptcha V3
$GLOBALS['TL_DCA']['tl_form_field']['config']['onload_callback'][] = function() {

    if( \Config::get('recaptchaType') != 'recaptcha3' ) {
        return;
    }

    $GLOBALS['TL_DCA']['tl_form_field']['palettes']['captcha'] = str_replace('{fconfig_legend},', '{fconfig_legend},recaptcha3_threshold,recaptcha3_action,', $GLOBALS['TL_DCA']['tl_form_field']['palettes']['captcha']);
};

$GLOBALS['TL_DCA']['tl_form_field']['fields'] += [
    'recaptcha3_threshold' => [
        'label'             => &$GLOBALS['TL_LANG']['tl_form_field']['recaptcha3_threshold'],
        'inputType'         => 'text',
        'sql'               => "varchar(8) NOT NULL default ''",
        'eval'              => ['tl_class' => 'w50 clr'],
    ],
    'recaptcha3_action' => [
        'label'             => &$GLOBALS['TL_LANG']['tl_form_field']['recaptcha3_action'],
        'inputType'         => 'text',
        'sql'               => "varchar(120) NOT NULL default ''",
        'eval'              => ['tl_class' => 'w50', 'rgxp' => 'recaptcha']
    ],
];