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
        return idn_to_ascii(self::correct($domain));
    }
    
    /**
     * @param string $domain
     * @return string
     */
    public static function toUnicode( $domain )
    {
        return idn_to_utf8(self::correct($domain));
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
