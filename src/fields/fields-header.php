<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$fields = new FieldsBuilder('Header Settings');
$fields->setLocation('options_page', '==', 'acf-options-header');

$fields;

add_action('acf/init', function () use ($fields) {
    acf_add_local_field_group($fields->build());
});
