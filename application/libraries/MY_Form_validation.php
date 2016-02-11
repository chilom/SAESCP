<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Form validation for UK Postcodes
 * 
 * Check that its a valid postcode
 * @author James Mills <james@koodoocreative.co.uk>
 * @version 1.0
 * @package FriendsSavingMoney
 */

class MY_Form_validation extends CI_Form_validation
{

    function __construct()
    {
        parent::__construct();  
        log_message('debug', '*** Hello from MY_Form_validation ***');
    }

    function valid_postcode($postcode)
    {

        /**
         *
         * UK Postcode validation expression from Wikipedia
         * http://en.wikipedia.org/wiki/Postcodes_in_the_United_Kingdom
         *
         * Note: Remember to strtoupper() your postcode before inserting into database!
         *
         */

        $pattern = "/^(GIR 0AA)|(((A[BL]|B[ABDHLNRSTX]?|C[ABFHMORTVW]|D[ADEGHLNTY]|E[HNX]?|F[KY]|G[LUY]?|H[ADGPRSUX]|I[GMPV]|JE|K[ATWY]|L[ADELNSU]?|M[EKL]?|N[EGNPRW]?|O[LX]|P[AEHLOR]|R[GHM]|S[AEGKLMNOPRSTY]?|T[ADFNQRSW]|UB|W[ADFNRSV]|YO|ZE)[1-9]?[0-9]|((E|N|NW|SE|SW|W)1|EC[1-4]|WC[12])[A-HJKMNPR-Y]|(SW|W)([2-9]|[1-9][0-9])|EC[1-9][0-9]) [0-9][ABD-HJLNP-UW-Z]{2})$/";


        if (preg_match($pattern, strtoupper($postcode)))
    {
            return TRUE;
        } 
        else
        {
            $this->set_message('valid_postcode', 'Please enter a valid postcode');
            return FALSE;
        }
    }
    
    
    
    function valid_url_format($str) {
        $pattern = "|^http(s)?://[a-z0-9-]+(.[a-z0-9-]+)*(:[0-9]+)?(/.*)?$|i";
        if (!preg_match($pattern, $str)) {
            $this->set_message('valid_url_format', 'La URL no tiene el formato solicitado');
            return FALSE;
        }

        return TRUE;
    }

    // --------------------------------------------------------------------



    function url_exists($url) {
        $url_data = parse_url($url); // scheme, host, port, path, query
        if (!fsockopen($url_data['host'], isset($url_data['port']) ? $url_data['port'] : 80)) {
            $this->set_message('url_exists', 'La URL no es accesible');
            return FALSE;
        }

        return TRUE;
    }
}

