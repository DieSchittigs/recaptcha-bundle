<?php

$GLOBALS['TL_DCA']['tl_form_field']['fields'] += [
    'recaptch3_threshold' => [
        'label'             => &$GLOBALS['TL_LANG']['tl_form_field']['recaptcha3_threshold'],
        'inputType'         => 'text',
        'sql'               => "varchar(8) unsigned NOT NULL default ''",
        'eval'              => ['tl_class' => 'w50 clr'],
    ],
    'recaptcha3_action' => [
        'label'             => &$GLOBALS['TL_LANG']['tl_form_field']['recaptcha3_action'],
        'inputType'         => 'text',
        'sql'               => "varchar(120) unsigned NOT NULL default ''",
        'eval'              => ['tl_class' => 'w50', 'rgxp' => 'recaptcha']
    ],
];

if (Config::get('recaptchaType') != 'recaptcha3') return;

$GLOBALS['TL_DCA']['tl_form_field']['palettes']['captcha'] = str_replace(',type,label', ',type,label,recaptcha3_threshold,recaptcha3_action', $GLOBALS['TL_DCA']['tl_form_field']['palettes']['captcha']);
