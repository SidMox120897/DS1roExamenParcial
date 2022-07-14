<?php
class Group73{
    function csv_Array($file){
        $tmp      = $file["tmp_name"];
        #$filename = $file["name"];
        $size     = $file["size"];
        if ($size < 0) {
            throw new Exception("Selecciona un archivo válido por favor.");
          }
          $fila = 0;
            #Vamos abrir los archivos 
            if (($gestor = fopen($tmp, "r")) !== FALSE) {
                while (($datos = fgetcsv($gestor, 1000, ",")) !== FALSE) {
                    //echo "<p> $numero de campos en la línea $fila: <br /></p>\n";
                    #Creamos un arreglo Bidimencional 
                    $val_doc=substr($datos[0], 0, 7);
                    if(strlen($datos[1])>1 and ($val_doc != "Docente" and strtolower($datos[0]) != "codigo" 
                    and strtolower($datos[1]) != "codigo"  and $datos[0]!="Nuevo Tutorado")){
                        if(strlen($datos[0])>=4){
                            $Arreglo[$fila][0]=$datos[0];
                            $Arreglo[$fila][1]=$datos[1];
                        }
                        else{
                            $Arreglo[$fila][0]=$datos[1];
                            $Arreglo[$fila][1]=$datos[2];
                            
                        }
                        $fila++;
                    }
                }
                fclose($gestor);
            }
            return $Arreglo;
    }
    function Imprimir($Array){
        if(!empty($Array)){
            $Pos=0;
            for($row = 0; $row < count($Array); $row++){
                $Pos++;
                echo '<tr><th>'.$Pos.'</th><th>'.$Array[$row][0].'</th><th>'.$Array[$row][1].'</th></tr>';
            }
        }
    }
    function Diferencia($ArrA,$ArrB){
        $fila=0;
        $Arreglo=array();
        for($x = 0; $x < count($ArrA); $x++){
            $Existe=false;
            for($y = 0; $y < count($ArrB); $y++){
                if($ArrA[$x][0]==$ArrB[$y][0]){
                    $Existe=true;
                    break;
                }
            }
            if($Existe==false){
                $Arreglo[$fila][0]=$ArrA[$x][0];
                $Arreglo[$fila][1]=$ArrA[$x][1];
                $fila++;
            }
        }
        return $Arreglo;
    }
}
?>