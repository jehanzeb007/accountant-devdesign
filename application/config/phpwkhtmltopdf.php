<?php
/**
 * phpwkhtmltopdf config
 * @link https://gist.github.com/DykiSA/1b768c3e296a983a0b398b2b3a08a07d
 * @source https://github.com/mikehaertl/phpwkhtmltopdf
 */

/**
 * path to the wkhtmltopdf executable
 */

$config['phpwkhtmltopdf']['binary']['i386'] = FCPATH.'vendor/h4cc/wkhtmltopdf-i386/bin/wkhtmltopdf-i386';
$config['phpwkhtmltopdf']['binary']['amd64'] = FCPATH.'vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64';


/**
 * path to store generated temp files
 */
$config['phpwkhtmltopdf']['tmpDir'] = APPPATH . '../temp/';


$config['phpwkhtmltopdf']['commandOptions'] = [
    'useExec' => true
];

// $config['phpwkhtmltopdf']['margin-top'] = 20;
// $config['phpwkhtmltopdf']['margin-right'] = 20;
// $config['phpwkhtmltopdf']['margin-bottom'] = 20;
// $config['phpwkhtmltopdf']['margin-left'] = 20;
$config['phpwkhtmltopdf']['user-style-sheet'] = FCPATH . 'assets/dist/css/pdfStyle.css';