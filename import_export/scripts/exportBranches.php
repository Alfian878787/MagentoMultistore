<?php
/*
 *  Dir ::  cd C:\Zend\Apache2\htdocs\learning2\import_export\scripts
 * Sample Run :: php exportBranches.php
 */
require_once("../../shell/abstract.php");
require_once("Functions.php");
Functions::safeMode(0,  __FILE__, __LINE__ );


class exportBranchs extends Mage_Shell_Abstract{
    public function run() {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $fp = FUNCTIONS::prepareFile('../export', '/file', 'csv', TRUE );

        $query = "SELECT * FROM storelocator_branches";
        $result =  $readConnection->fetchAll($query);

        $i=0;
        foreach ($result as $row){ $i++;
            if ( $i == 1 )
            fputcsv($fp, array_keys($row));
            fputcsv($fp, array_values($row));
        }
    }
}
$import = new exportBranchs();
$import->run();
