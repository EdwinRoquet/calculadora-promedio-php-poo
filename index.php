<?php

//Objto alumno
class Alumno
{
 //Propiedades del objeto
 public $nombre;
 public $rut;
 public $calificaciones;
 public $promedio = 0;
  
 //Constructor del objeto
  public function __construct( $nombre, $rut, $calificaciones)
  {
    //Asignacion de los valores que recibe el constructor a las propiedades
    $this->nombre = $nombre;
    $this->rut = $rut;
    $this->calificaciones = $calificaciones;  
    //Se manda ejecutar una vez se crea el objeto, la cual calcula el promedio
    $this->calcularPromedio();
  }

  //Metodo que calcula el promedio
  public function calcularPromedio()
 {   
     //Suma todas los valores del arreglo
    $sumaArreglo = array_sum($this->calificaciones);
    //Cuenta las posiciones del arreglo
    $PosiscionesArreglo = count($this->calificaciones);
    //Se calcula el primedio
    $this->promedio = $sumaArreglo / $PosiscionesArreglo;
    return $this->promedio;
 }

}

//objeto curso
class Curso
{
//Propiedades del objeto
 public $alumnos;
 public $totaAlumnos = 0;
 public $alumnosAprobados = 0;
 public $alumnosReprobados = 0;
 public $promedioCurso = [];
 public $rutCaMasAlta = [];
 public $porcentajeRepro;

 
 //Constructor que recibe un arreglo
 public function __construct($alumnos)
 {   
     //Asignamos el valor del constructor a la propiedad
     $this->totaAlumnos = $alumnos;
     $this->alumnos = $alumnos;
     //Funciones que se manda a llamar inmediantemente se crea el objeto
     $this->totalAlumnos();
     $this->calcularAlumnosAprobados();
     $this->alumnoMejorProm();
     $this->porcentajeReprobado();
 }
 //calcula el total de alumnos
 public function totalAlumnos()
 {
    return $this->totaAlumnos = count($this->totaAlumnos);
 }
//Calcula los alumnos aprobados y reprobados
 public function calcularAlumnosAprobados()
 {
    //Recorre el arreglo de de alumnos
    foreach ($this->alumnos as $alumno) {
        // echo"<br>";
        // Agregamos un valor si el promedio es mayor a 7 si es menos agregamos uno  a propiedad reprobados
        if ($alumno->promedio > 7) {
           $this->alumnosAprobados++;
        } else {
           $this->alumnosReprobados++;
        }     
    }
   
 }

 public function promedioCursoA()
 {
    //Calculamos el promedio total del curso
    foreach ($this->alumnos as $alumno) {
        //Agregamos todos los promedios a un arreglo
        array_push($this->promedioCurso,$alumno->promedio);
       
    } 
     //Calculamos el promedio del arreglo y lo volvemos a guardar en la misma propiedad 
     return $this->promedioCurso = array_sum( $this->promedioCurso) /  count( $this->promedioCurso);
      
 }
 //Metodo con el Alumno con Mejor promedio
 public function alumnoMejorProm()
 {  
    //Recorremos el metodo alumnos y guardamos en la propieda rutCatMasAlta todos los propmedios
    foreach ($this->alumnos as $alumno) {
        
        array_push($this->rutCaMasAlta,$alumno->promedio);
        
    }  
    //Sacamos que valor del arreglo tiene el valor mas alto
    $mejorPromedio  = max($this->rutCaMasAlta);
    // echo $mejorPromedio;
    
    //Recorremos otra vez los alumnos en busca de comparar quien te la calificacion mas alta
    foreach ($this->alumnos as $alumno) {
            //Se compara los promedios y guardamos los datos en la misma propiedad
         if ($alumno->promedio == $mejorPromedio) {
             $this->rutCaMasAlta = [];
            array_push($this->rutCaMasAlta, $alumno->nombre, $alumno->rut ,$alumno->promedio);
         }
          
    } 

 }
  //Metodo que calcula el porcentaje
 public function porcentajeReprobado()
 {
    $this->porcentajeRepro =   ($this->alumnosReprobados * 100) / $this->totaAlumnos;
 }


}

//Arreglo de Alumnos  con objetos  y propiedad de nombre, rut y calificaciones
$alumnos = [
    new Alumno('Pedro',   '0001',[10,10,6,8,8,9]),
    new Alumno('Maria',   '0002',[7,7,6,8,8,9]),
    new Alumno('Juana',   '0003',[8,8,7,8,10,6]),
    new Alumno('Felipe',  '0004',[10,10,10,10,10,9]),
    new Alumno('Carolina','0005',[7,7,9,8,8,8]),
    new Alumno('Luis',    '0006',[5,3,5,5,5,5]),
];

//Instancia del objeto curso
$curso = new Curso($alumnos);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

</head>
<body>
      <h2 class="text-center">Calificaciones</h2>
    <div class="container row">
        <div class="col-md-3">
<button class="btn btn-primary m-1 btn-block"  onclick="mostraruno()"  type="button">Promedio del curso</button>
            <button class="btn btn-primary m-1 btn-block" type="button">Rut Calificación mas alta</button>
            <button class="btn btn-primary m-1 btn-block" type="button">Alumnos Aprobados</button>
            <button class="btn btn-primary m-1 btn-block" type="button">Alumnos Reprobados</button>
            <button class="btn btn-primary m-1 btn-block" type="button">Porcentaje Alumnos Reprobados</button>
            <button class="btn btn-primary m-1 btn-block" type="button">Alumnos Procesados</button>
        </div>
        <div class="col-md-9">
            <!-- Se imprimen todos los valores de la propiedades del objeto de acuerdo a su origen -->
            <div class="mt-3 " style="display: block;" id="uno"> Promedio del curso <?php echo $curso->promedioCursoA(); ?></div>
            <div class="mt-3" style="display: block;" id="dos"> Rut del Alumno: <?php  echo $curso->rutCaMasAlta[1] . ' - '. " <span> Promedio: ".  $curso->rutCaMasAlta[2] ."</span>";
            ?>   
            </div>
            <div class="mt-3 " style="display: bloc;" id="tres"> Alumnos   <?php   echo $curso->alumnosAprobados; ?>   </div>
            <div class="mt-3 " style="display: bloc;" id="cuatro"> Alumnos <?php  echo $curso->alumnosReprobados;  ?> </div>
            <div class="mt-3 " style="display: bloc;" id="cinco">     <?php  echo $curso->porcentajeRepro;  ?>  </div>
            <div class="mt-3 " style="display: bloc;" id="seis">Total de Alumnos  <?php   echo $curso->totaAlumnos ?>  </div>
    </div>

    </div>

    
   

 
</body>
</html>
|   