<?php

    if( !isset( $_SESSION['userid'] ) ){
        header( 'Location: ../resultados.php' );
        die();
    }

    $archivo_con_votos = 'elecciones2023.dat';

    $total_votos = [
        'candidato1' => 0,
        'candidato2' => 0,
        'candidato3' => 0
    ];

    if( file_exists( $archivo_con_votos ) ){
        $file = fopen( $archivo_con_votos, 'r' );

        while( !feof( $file ) ){

            $voto = fgets( $file );
            if( empty( $voto ) ) continue;
            $datos_del_voto = explode( ',', trim( $voto ) );

            foreach( $datos_del_voto as $campo ){
                list( $key, $value ) = explode( '=', $campo );
                if( $key === 'candidato' ) {
                   $total_votos[$value] += 1; 
                }
            }
        }
        fclose( $file );
    } else die('No existe el archivo de votantes');