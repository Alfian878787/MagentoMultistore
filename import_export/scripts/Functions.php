<?php

require_once("../../shell/abstract.php");
class Functions {

    public function cleanData($data){
        $data = trim(preg_replace('/\s\s+/', ' ',  $data));
        $data = preg_replace( "/\r|\n/", "", $data );
        $data = str_replace("\r\n","",$data);
        $data = str_replace("\n","",$data);
        $data = str_replace("\r","",$data);
        return $data;
    }
    public function prepareFile($exportDir, $exportFile, $type ='csv', $echoFile=FALSE, $date=TRUE ){ // FUNCTIONS::prepareFile('../data', '/file', 'txt', TRUE )
        $exportFile .= ($date) ?  date('_Y_m_d_H_i') : '';
        $exportFile .= ($type) ? '.'.$type : '';
        $fileNane = $exportDir.'/'.$exportFile;
        if (!is_dir($exportDir)) { mkdir($exportDir, 0777, true); }
        $fp = fopen($fileNane, 'w+');
        if ($echoFile) echo "\n Log File Location : ".$fileNane."\n";
        return $fp;
    }

    public function cleanArray($row){
        $cleanArray=array();
        foreach ($row as $key=>$col){
            $cleanArray[$key] = ($this-> cleanData($col)) ? $this-> cleanData($col) : NULL ;
        }
        return $cleanArray;
    }
    public function safeMode($safeMode, $file, $line){
        echo "\n\n ######################## Please Wait ########################## \n\n ";
        $completed = "\n\n ######################## *********** ########################## \n\n ";
        $comment = " SAFE MODE TURNED ON \n";
        $comment .= " Set safeMode(0); to run this script in \n File :: " . $file . "\n Line :: ". $line."\n";
        $comment .= " Complete test before you run on Production Server.";
        if($safeMode)
            die(  $comment.$completed);
    }

    public function file_found($file_exists, $file){ // FUNCTIONS::file_found(file_exists('../data/mailorder.csv'), '../data/mailorder.csv' )
        if ($file_exists){
            return 'File exists on Server >> '.$file;
        }else{
            echo 'Can not locate file '.$file. "\n This script will not run. \n\n\n";
            die();
        }
    }

    private function removeLineFeed($data ){
        $data = preg_replace('/\s+/',',',str_replace(array("\r\n","\r","\n"),' ',trim($data)));
        $data = preg_replace('#\s+#',',',trim($data));
        return $data;
    }

    private function xmlCharacterEscape($data ){
        $data = str_replace("&", '&#38;', $data );
        $data = str_replace('"', '&#34;', $data );
        $data = str_replace("'", '&#39;', $data );
        $data = str_replace('<', '&#60;', $data );
        $data = str_replace('>', '&#62;', $data );
        return $data;
    }

    private function logFile( $data ){
    }

    public function finalReport ($counter, $success, $time, $fp=NULL, $logFile=FALSE, $echo=TRUE ){  // FUNCTIONS::finalReport ($counter, $totalSaved, $time);
        $LF="\n";
        $message = $LF." ============== REPORT ================,".$LF.
            " Success Rate : " . ($success/$counter)*100  ."%,".$LF.
            ' Time Required : '. (int)$time . " seconds, ".$LF.
            " Succeeded : " . $success  .",".$LF.
            ' Failed : '.($counter - $success). ",".$LF.
            ' Processed : '.$counter.",".$LF;
        $message .= ($logFile) ? ' Log File location : '.$logFile.",".$LF : NULL;
        $message .= " Error and counter may not be accurate, ".$LF;
        $message .=" ============== END REPORT =============" ;
        if ($echo){ echo $message; }
        if ($fp){
            $message = explode ( ',', str_replace("\n","",$message));
            fputcsv($fp,   array_values($message));
        }
        return $message;
    }

}
