<?php
/**
 * Created by PhpStorm.
 * User: murattanriover
 * Date: 24.05.15
 * Time: 20:56
 */

namespace App\Library;


class MapSystemClasses {

    public static function mapSystemClasses($controllerdir,$onlypublic=true) {
        if($controllerdir==null) $controllerdir = app_path().'/Http/Controllers/'; // Controllers path
        $result=array();
        $dh=opendir($controllerdir);
        while (($file = readdir($dh)) !== false) {
            if (substr($file,0,1)!=".") {
                if (filetype($controllerdir.$file)=="file") {
                    $classes=self::file_get_php_classes($controllerdir.$file,$onlypublic);
                    foreach($classes['methods'] as $class=>$method) {
                        $result[]=array("file"=>$controllerdir.$file,"class"=>$class,"namespace"=>$classes['namespace'],"method"=>$method);
                    }
                } else {
                    $result=array_merge($result,self::mapSystemClasses($controllerdir.$file."/",$onlypublic));
                }
            }
        }
        closedir($dh);
        return $result;
    }

    private static function file_get_php_classes($filepath,$onlypublic=true) {
        $php_code = file_get_contents($filepath);
        return self::get_php_classes($php_code,$onlypublic);
    }

    private static function  get_php_classes($php_code,$onlypublic) {
        $methods=array();
        $namespace = "";
        $tokens = token_get_all($php_code);
        $count = count($tokens);
        for ($i = 2; $i < $count; $i++) {
            if ($tokens[$i-2][0] === T_NAMESPACE) {
                for ($j=$i+1;$j<count($tokens); $j++) {
                    if ($tokens[$j][0] === T_STRING) $namespace .= '\\'.$tokens[$j][1];
                    else if ($tokens[$j] === '{' || $tokens[$j] === ';') break;
                }
                $namespace = str_replace("\\Http\\Controllers","",$namespace);
                $namespace = ltrim($namespace,"\\");
            }
            if ($tokens[$i - 2][0] == T_CLASS && $tokens[$i - 1][0] == T_WHITESPACE && $tokens[$i][0] == T_STRING) {
                $class_name = $tokens[$i][1];
                $methods[$class_name] = [];
            }
            if ($tokens[$i - 2][0] == T_FUNCTION && $tokens[$i - 1][0] == T_WHITESPACE && $tokens[$i][0] == T_STRING) {
                if ($onlypublic) {
                    if ( !in_array($tokens[$i-4][0],array(T_PROTECTED, T_PRIVATE))) {
                        $method_name = $tokens[$i][1];
                        $methods[$class_name][] = $method_name;
                    }
                } else {
                    $method_name = $tokens[$i][1];
                    $methods[$class_name][] = $method_name;
                }
            }
        };
        return ['namespace'=>$namespace,'methods'=>$methods];
    }
}