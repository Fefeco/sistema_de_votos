<?php
    session_start();
    // Datos generados mediante IA
    $fechas = [  "2003-08-15",  "2002-11-22",  "2000-04-03",  "2001-09-11",  "2000-12-25",  "1999-07-07",  "2002-03-18",  "2003-06-30",  "2001-02-14",  "1999-05-20",  "2000-10-08",  "2001-01-12",  "2002-05-09",  "1998-12-31",  "1999-08-27",  "2002-02-03",  "2000-09-05",  "1999-03-26",  "2003-04-17",  "2001-07-23",  "2002-10-28",  "2000-06-19",  "1998-10-15",  "1999-12-07",  "2003-01-28",  "2001-04-09",  "2000-08-22",  "1998-11-14",  "2002-08-10",  "2003-02-19",  "1999-11-05",  "2001-05-01",  "2000-01-06",  "1998-09-24",  "2002-04-14",  "2003-03-07",  "2001-08-26",  "1999-10-04",  "2000-07-16",  "1998-08-08",  "1999-01-29",  "2003-05-12",  "2001-03-03",  "2002-07-21",  "2000-02-17",  "1998-07-13",  "1999-09-02",  "2003-07-04",  "2001-06-11",  "2002-09-15"];

    $nombres = ["Juan", "María", "Pedro", "Ana", "Luis", "Laura", "Carlos", "Sofía", "Diego", "Valentina", "Javier", "Isabella", "Miguel", "Camila", "Andrés", "Lucía", "José", "Valeria", "Daniel", "Paula", "Fernando", "Natalia", "Ricardo", "Carolina", "Antonio", "Marta", "Alejandro", "Elena", "Gustavo", "Isabel", "Raúl", "Victoria", "Manuel", "Beatriz", "Jorge", "Adriana", "Roberto", "Monica", "Francisco", "Clara", "Alberto", "Patricia", "Guillermo", "Verónica", "Emilio", "Silvia", "Rafael", "Carmen", "Héctor", "Xabi"];

    $apellidos = [  "González Pérez",  "López García",  "Rodríguez Martínez",  "Hernández López",  "Martínez Rodríguez",  "Pérez González",  "Sánchez López",  "Fernández González",  "García Rodríguez",  "Torres Sánchez",  "Díaz Pérez",  "Ramírez Martínez",  "Vargas López",  "Ruiz González",  "Molina García",  "Ortega Rodríguez",  "Castro López",  "Vega González",  "Navarro Pérez",  "Soto Martínez",  "Jiménez López",  "Ramos Rodríguez",  "Paredes Sánchez",  "Reyes González",  "Guerrero Pérez",  "Flores Martínez",  "Silva López",  "Medina Rodríguez",  "Núñez Sánchez",  "Cabrera Pérez",  "Morales García",  "León Rodríguez",  "Cruz López",  "Carrillo González",  "Olivares Pérez",  "Villanueva Martínez",  "Iglesias López",  "Pacheco Rodríguez",  "Peña Sánchez",  "Gómez González",  "Campos Pérez",  "Lara Martínez",  "Aguilar López",  "Ríos Rodríguez",  "Mendoza Sánchez",  "Suárez Pérez",  "Benítez González",  "Castillo López",  "Espinoza Rodríguez",  "Flores Sánchez"];

    $dni = [  "12345678A",  "98765432B",  "56789012C",  "34567890D",  "87654321E",  "23456789F",  "65432109G",  "45678901H",  "34567890I",  "56789012J",  "78901234K",  "89012345L",  "67890123M",  "45678901N",  "23456789O",  "78901234P",  "12345678Q",  "89012345R",  "56789012S",  "34567890T",  "23456789U",  "45678901V",  "34567890W",  "78901234X",  "56789012Y",  "67890123Z",  "78901234A",  "56789012B",  "34567890C",  "12345678D",  "23456789E",  "67890123F",  "78901234G",  "45678901H",  "56789012I",  "23456789J",  "89012345K",  "34567890L",  "12345678M",  "56789012N",  "78901234O",  "89012345P",  "45678901Q",  "23456789R",  "67890123S",  "56789012T",  "34567890U",  "12345678V",  "45678901W",  "56789012X",  "78901234Y",  "89012345Z"];

    // Candidatos
    $candidatos = ['candidato1', 'candidato2', 'candidato3'];

    function bucle_candidatos( $file, $fechas, $nombres, $apellidos, $dni, $candidatos ){
        foreach( $fechas as $key => $value ){
            $candidato = rand(0, count($candidatos) -1 );
            $linea = 'birthday='.$value.','.'name='.$nombres[$key].','.'lastname='.$apellidos[$key].','.'dni='.$dni[$key].','.'candidato='.$candidatos[$candidato];
            fwrite( $file, $linea."\n" );
        }
    }

    if( file_exists( 'elecciones2023.dat' ) ){
        @$file = fopen( 'elecciones2023.dat', 'a' );
        if( $file ){
            bucle_candidatos( $file, $fechas, $nombres, $apellidos, $dni, $candidatos );
        } else die('ERROR permiso de escritura');
            
    } else {
        @$file = fopen( 'elecciones2023.dat', 'w' );
        if( $file ){
            bucle_candidatos( $file, $fechas, $nombres, $apellidos, $dni, $candidatos );
        } else die('ERROR permiso de escritura');
    }
    fclose( $file );
    unset( $linea );
    $_SESSION['mensaje_exito'] = 'Su voto ha sido registrado con éxito';
    header('Location: index.php');
    die();