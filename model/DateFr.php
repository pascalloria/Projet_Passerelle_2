<?php

class DateToFr {
    public static function dateFR($date) {
        $dateTimestamp = strtotime($date);
        echo date('d/m/Y à H:i:s', $dateTimestamp + 3600); // gmt+1
    }
}