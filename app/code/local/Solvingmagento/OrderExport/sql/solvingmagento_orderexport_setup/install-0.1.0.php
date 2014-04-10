<?php
/**
 * Created by PhpStorm.
 * User: AMojumder
 * Date: 10/04/14
 * Time: 14:42
 */

$installer = $this;

$installer->startSetup();

$installer->run(
    "INSERT INTO `{$this->getTable('core_email_template')}`
    (`template_code`, `template_text`, `template_type`, `template_subject`)
    VALUES (
    'New Customer and First Order',
    'A first order by a new customer: {{htmlescape var=\$customer.getName()}}, id: {{var=\$customer.getId()}}',
    '2',
    'A first order by a new customer'
    )"
);

$installer->endSetup();