<?php

use StoutLogic\AcfBuilder\FieldsBuilder;

$backgroundColor = new FieldsBuilder('background_color');
$backgroundColor->addButtonGroup('background_color', [
    'choices' => [
        'bg-white' => 'White',
        'bg-gray' => 'Gray',
        'bg-primary' => 'Primary',
        'bg-secondary' => 'Secondary',
    ],
]);

$modules = new FieldsBuilder('Modular Template', ['hide_on_screen' => ['the_content']]);

$modules->setLocation('post_template', '==', 'default')->or('post_type', '==', 'template')->or(
    'post_type',
    '==',
    'case-study'
);

$htmlTags = ['p', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'];

/* Modules */
$predefinedTemplate = new FieldsBuilder('predefined_template');
$predefinedTemplate
    ->addPostObject('template', [
        'post_type' => ['template'],
        'multiple' => true,
        'instructions' => 'If you want to create module that should be exactly the same on multiple pages, <a href="/wp-admin/edit.php?post_type=template">create new template</a>, configure modules and select created template to include it.',
    ]);


$example = new FieldsBuilder('example');
$example
    ->addText('title');

$modules
    ->addFlexibleContent('sections')
    ->addLayout($predefinedTemplate)
    ->addLayout($example);

add_action('acf/init', function () use ($modules) {
    acf_add_local_field_group($modules->build());
});
