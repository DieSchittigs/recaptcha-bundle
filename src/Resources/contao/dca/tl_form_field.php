<?php

$GLOBALS['TL_DCA']['tl_form_field']['fields']['recaptcha3_threshold'] = [
    'label'             => &$GLOBALS['TL_LANG']['tl_form_field']['recaptcha3_threshold'],
    'inputType'         => 'text',
    'sql'               => "varchar(8) unsigned NOT NULL default '0'",
    'eval'              => ['tl_class' => 'w50']
];