<?php
    function calculo_porcentaje( $total_votos ){
        $total = array_sum( $total_votos );
        $porcentajes = array();
        foreach( $total_votos as $candidato => $votos ){
            $porcentajes[$candidato] = sprintf( "%.2f", ( $votos / $total ) * 100 ); 
        }
        return $porcentajes;
    }