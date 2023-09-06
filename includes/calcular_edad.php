<?php

    function calcular_edad( $nacimiento ){
        list( $year, $month, $day ) = explode( '-', $nacimiento );
        list( $actual_year, $actual_month, $actual_day ) = explode( '-', date( 'Y-m-d' ) );

        if( $actual_month === $month ){
            if( $actual_day > $day ){
                $actual_year -= 1;
            }
        }
        if( $actual_month > $month ){
            $actual_year -= 1;
        }

        return $actual_year - $year;
    }