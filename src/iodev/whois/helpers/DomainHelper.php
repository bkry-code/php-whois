<?php

namespace iodev\whois\helpers;

/**
 * @author Sergey Sedyshev
 */
class DomainHelper
{
    /**
     * @param string $a
     * @param string $b
     * @return string
     */
    public static function compareNames( $a, $b )
    {
        $a = self::toAscii($a);
        $b = self::toAscii($b);
        return ($a == $b);
    }
    
    /**
     * @param string $domain
     * @return string
     */
    public static function toAscii( $domain )
    {
        $cor = self::correct($domain);
        if (function_exists("idn_to_ascii")) {
            return idn_to_ascii($cor);
        }
        return $cor;
    }
    
    /**
     * @param string $domain
     * @return string
     */
    public static function toUnicode( $domain )
    {
        $cor = self::correct($domain);
        if (function_exists("idn_to_utf8")) {
            return idn_to_utf8($cor);
        }
        return $cor;
    }
    
    /**
     * @param string $domain
     * @return string
     */
    public static function correct( $domain )
    {
        return mb_strtolower(rtrim(trim($domain), '.'));
    }
    
}
