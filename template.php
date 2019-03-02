<?php


class Plater{

    protected
            $template     = "",
            $replacements = array(),
            $cssFiles = array(),
            $disableTidy = false;

    public function __construct(){

    }

    public function show($filename){
        try{
            $this->template = $this->import($filename);
            $this->format();
            echo $this->template;
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }

    public function attachCSS($filename = null){
        $tmp = $this->template;
        if(empty($filename)){
            $matches = array();
            preg_match_all("/\\\$attachCSS\((\"|')(.+)(\"|')\);/U", $tmp, $matches);
            $tmp = preg_replace("/\\\$attachCSS\((\"|')(.+)(\"|')\);/U", "", $tmp);
            foreach($matches[2] as $filename){
                $this->cssFiles[] = $this->import($filename);
            }
            $this->template   = $tmp;
        }else{
            $this->cssFiles[] = $this->import($filename);
        }
    }

    public function import($filename){
        if(!is_file($filename)){
            throw new Exception("Could not find \"<b>$filename</b>\" it does not exist.");
        }
        return file_get_contents($filename);
    }

    public function assign($key, $value){
        $this->replacements[$key] = $value;
    }

    public function disableTidy($boolean){
        $this->disableTidy = (bool)$boolean;
    }

    private function format(){
        $this->loadIncludes();
        $this->get();
        $this->post();
        $this->session();
        $this->server();
        $this->cookie();
        $this->template = $this->removeComments();
        $this->runWhileLoops();
        $this->template = $this->replaceTags();
        $this->loadIncludes();
        $this->template = $this->replaceTags();
        $this->template = $this->removeEmptyTags();
        $this->attachCSS();
        $this->template = $this->replaceCSS();
//        if(!$this->disableTidy){
  //          $this->template = $this->tidy();
    //    }
    }

    private function tidy(){
        if(class_exists("tidy")){
            $tmp    = $this->template;
            $tidy   = new \tidy();
            $config = array(
                "indent"        => true,
                "indent-spaces" => 4,
                "clean"         => true,
                "wrap"          => 200,
                "doctype"       => "html5"
            );
            $tidy->parseString($tmp, $config, 'utf8');
            $tidy->cleanRepair();
            $string         = $tidy;
        }
        return $string;
    }

    private function get(){
        foreach($_GET as $k => $v){
            $this->replacements["get." . $k] = $v;
        }
    }

    private function post(){
        foreach($_POST as $k => $v){
            $this->replacements["post." . $k] = $v;
        }
    }

    private function server(){
        foreach($_SERVER as $k => $v){
            $this->replacements["server." . $k] = $v;
        }
    }

    private function session(){
        if(isset($_SESSION)){
            foreach($_SESSION as $k => $v){
                $this->replacements["session." . $k] = $v;
            }
        }
    }

    private function cookie(){
        foreach($_COOKIE as $k => $v){
            $this->replacements["cookie." . $k] = $v;
        }
    }

    private function loadIncludes(){
        $tmp     = $this->template;
        $matches = array();
        preg_match_all('/(\\$import\(("|\')(.+?)("|\')\).*;)/i', $tmp, $matches);
        //print_r($matches);
        $files   = $matches[3];
        $replace = 0;
        foreach($files as $key => $file){
            $command        = preg_replace("/\\\$import\((\"|').+?(\"|')\)/", "", $matches[0][$key]);
            $string         = $this->import($file);
            $string         = $this->runFunctions($string, "blah" . $command);
            $f              = preg_quote($file, "/");
            $tmp            = preg_replace('/\\$import\(("|\')' . $f . '("|\')\).*;/i', $string, $tmp);
            $replace++;
        }
        $this->template = $tmp;
        if($replace > 0){
            $this->loadIncludes();
        }
    }

    private function runWhileLoops(){
        $tmp     = $this->template;
        $matches = array();
        preg_match_all("/\\\$each\((\"|')(.+)(\"|')\):(.+)\\\$endeach;/isU", $tmp, $matches);
        if(isset($matches[4]) && !empty($matches[4]))  {
            // Loop over all $each found.
            foreach($matches[4] as $id => $match){
                $new   = "";
                $match = "";
                $name  = $matches[2][$id];      // $each variable - e.g. $each('images') --> images.
                $ntmp  = $matches[4][$id];      // the HTML between the $each AND $endeach.
                // is name in array?
                if(isset($this->replacements[$name])){
                    // if so loop over all occurances of it.
                    foreach($this->replacements[$name] as $val){
                        $t = $this->replaceTags  ( $val , $ntmp);
                        $xif =  $this->if_conditions( $t , $val );
                        $new .= $xif;
                    }
                }
                $name           = preg_quote($name);
                $tmp            = preg_replace("/\\\$each\((\"|')$name(\"|')\):(.+)\\\$endeach;/isU", $new, $tmp);
            }
        }
        $this->template = $tmp;
    }

    private function replaceCSS(){
        $tmp = $this->template;
        $css = "<style>\n";
        foreach($this->cssFiles as $cssStr){
            $css .= "$cssStr\n";
        }
        $css .= "</style>\n";
        if(preg_match("/<\/head>/i", $tmp)){
            $tmp = preg_replace("/<\/head>/i", "$css</head>", $tmp, 1);
        }else{
            $tmp .= $css;
        }
        return $tmp;
    }

    private function replaceTags($keys = null, $tmp = null){
        if(empty($tmp)){
            $tmp = $this->template;
        }

        if(!empty($keys)){
            $replacements = $keys;
        }else{
            $replacements = $this->replacements;
        }

        $i=0;
        $xif='';
        $tmp1='';
        foreach($replacements as $key => $value){
            if(is_array($value)){
                continue;
            }
            $matches = array();
            preg_match_all('/\\$' . $key . '\..+?;/', $tmp, $matches);
            if(!empty($matches[0])){
                foreach($matches[0] as $match){
                    $result = $this->runFunctions($value, $match);
                    $m      = preg_quote($match);
                    $tmp    = preg_replace('/' . $m . '/', "$result", $tmp);                    
                }
            }
            if(!is_array($value)){
                $tmp = str_replace('$' . $key . ';', $value, $tmp);
            }
        }
        return $tmp;
    }

    private function runFunctions($value, $functions){
        $functions = explode(".", $functions);
        array_shift($functions);
        foreach($functions as $func){
            $func = trim($func, "$();");
            if(function_exists($func)){
                $value = $func($value);
                /* if(empty($value)){
                  throw new Exception("Invalid parameter for <b>$func</b> received \"<b>$v</b>\" within template.");
                  } */
            }
        }
        return $value;
    }

    private function removeEmptyTags(){
        $tmp = $this->template;
        $tmp = preg_replace("/\\$[^\"' ]+?;/", "", $tmp);
        return $tmp;
    }

    private function removeComments(){
        $tmp = $this->template;
        $tmp = preg_replace("/\/\\$.*\\$\//isU", "", $tmp);
        $tmp = preg_replace("/.*\\$\\$.+(\n|$)/iU", "", $tmp);
        return $tmp;
    }




    private function if_conditions($html,$ar) {
        if($html=='') { return null; }
        // find ALL occurances of if..else..endif in current layer.
        $template = preg_match_all('/\{if\s+(.*?)\}\s+(.*?)\s+(?:\{else\}\s+(.*?)\s+)?\{endif\}/s', $html  ,  $M  ,  PREG_SET_ORDER );
        // check for matches..
        if(!empty($M)){
            $i=0;
            //LOOP over if..else..endif matches.
            foreach ($M as $mm){
                // get the array of if..else..endif
                $condition=$mm[1];
                $cond = $this->_if_in_template($condition);
                if(!empty($cond)) {
                        $if_variable      =   $cond[0];   // if part
                        $if_comparison    =   $cond[1];   // == != < > etc..
                        $if_value         =   $cond[2];   // value
                        if(isset($ar[ $if_variable ])){
                              $val = $ar[ $if_variable ];   // actual val.
                        } else {
                              $val=null;
                        }
                        // $left_side:  value from TEMPLATE.
                        // $right_side: value from DATA.
                        $left_side  = $val;
                        $right_side = $if_value;
                        $if_result = $this->_if_compare_values( $left_side , $right_side , $if_comparison );
                        if( $if_result == true ) {
                            if(isset($mm[3])) {
                                $html = str_replace( $mm[3]   , '' , $html );
                            }
                        } else {
                             // IF statement is FALSE so remove Second part.
                             if(isset($mm[2] )){
                                 $html = str_replace( $mm[2]  , '', $html );
                             }
                        }
                    }
                    $i++;
                  } // end of FOREACH
             }
             $ret = $html;
            /*
             * STRIP OUT ALL {if} {else} {endif}
            */
            //$template = preg_match_all('/\{if\s+(.*?)\}\s+(.*?)\s+(?:\{else\}\s+(.*?)\s+)?\{endif\}/s', $html  ,  $M  ,  PREG_SET_ORDER );             
            $ret = preg_replace("/\{if\s+(.*?)\}/"  ,   ""  ,   $ret  );
            $ret = preg_replace("/\{endif}/"        ,   ""  ,   $ret  );            
            $ret = preg_replace("/\{else}/"         ,   ""  ,   $ret  );            



            return $ret;
        }



        private function _if_compare_values( $left_side,$right_side,  $if_comparison){
            $first = false;
            switch ( $if_comparison){
                case '==':
                    if($left_side==$right_side) { $first=true; }
                break;
                case '>':
                    if($left_side>$right_side) { $first=true; }                                                
                break;
                case '<':
                    if($left_side<$right_side) { $first=true; }                                                
                break;
                case '!=':
                    if($left_side!=$right_side) { $first=true; }
                break;
                case '>=':
                    if($left_side>=$right_side) { $first=true; }                                                
                break;
                case '<=':
                    if($left_side<=$right_side) { $first=true; }                                                
                break;
            }


            return $first;
        }



        private function _if_in_template($condition){
            if(strlen($condition)!=0) {
                $cond = explode(" " , $condition);
               if(!empty($cond)){
                   return $cond;
               } else {
                   return array();
               }
            }
        }


}


