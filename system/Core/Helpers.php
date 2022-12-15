<?php

namespace system\Core;

class Helpers{

    public static function formatValueDecimal(float $value=null): string {
        return number_format(($value ? $value : 0), 2, ',');
    }

    public static function formatValueThousands(float $value=null): string{
        return number_format(($value ? $value : 0), 0, ',', '.');
    }

    /**
     * 
     * @author Gabriel Chaves Martins
     */

    public static function validateEmail(string $email):bool{

        return filter_var(
            $email,
            FILTER_VALIDATE_EMAIL
        );
    }

    /**
     * Function to validate url
     * @param $url URL passed to the user
     * @author Gabriel Chaves Martins
     */

    public static function validateURL(string $url):bool{
        return filter_var(
            $url,
            FILTER_VALIDATE_URL
        );
    }


    /** Gets the user's passed time, subtract from now time and then returns
    * @author Gabriel Chaves Martins
    * @param string $recv_date User's passed date on the (Y-m-d HH:i:s) format
    * @return string Difference between passed date and now in years, months, days, hours, minutes or seconds format, it depends of the first one that isn't zero
    */
    public static function timeCounter(string $recv_date): string{
        $now = strtotime(date('Y-m-d H:i:s'));
        $dataToSec = strtotime($recv_date);

        $differenceBetweenTimes = $now - $dataToSec;
        $minutes = round($differenceBetweenTimes / 60);
        $hours = round($minutes / 60);

        $days = round($hours / 24);
        $months = round($days/30);

        $years = round($months / 12);

        $possible_times = array(
            "seconds" => $differenceBetweenTimes, 
            "minutes" => $minutes, 
            "hours" => $hours, 
            "days" => $days, 
            "months" => $months, 
            "years" => $years);

        foreach(array_reverse($possible_times) as $key => $value){
            if ($value != 0){
                return $key.':'.$value;
            }
        }
    }


    public static function greetings(): string{

        $message = '';
        $hour = date('H');

        if ($hour >= 0 && $hour <= 5){
            $message = 'Good Daybreak';

        }elseif($hour > 5 && $hour <= 12){
            $message = 'Good Morning';
        }elseif($hour > 12 && $hour <= 18){
            $message = 'Good Afternoon';
        }else{
            $message = 'Good Night';
        }

        return $message;

    }


    /** 

    * Sets a limit of characters on passed text,, if the number of characters is greater than the limit,
    * then we only catch the chars until the passed limit
    *
    *@param string $text Text passed to user
    *@param int $limit Limit of characters
    *@param string $continue (optional) Concatenate with the formatted text
    */
    public static function resumeText(string $text='', int $limit=10, string $continue='...'): string{
        $formatted_text = trim($text);
        if (mb_strlen($formatted_text) > $limit){
            $formatted_text = substr($formatted_text, 0, $limit);
        }

        return $formatted_text;
    }


    /**
     * This function sets an URL that depends on the URL script
     * @author Gabriel Chaves Martins
     * @param string $url URL that we want to set
     * 
     */

    public static function setURL(string $url = null): string{
        $server = filter_input(INPUT_SERVER, 'SERVER_NAME');
        $environment = ($server == 'localhost' || $server == '127.0.0.1' ? URL_DEVELOPMENT:URL_PRODUCTION);
        if (str_starts_with($url, '/')){
            return $environment.$url;
        }
        return $environment.'/'.$url;
    }


    /**
     * Function that verifies if the script is running on localhost
     */
    public static function isLocalHost(): bool{
        $server = filter_input(INPUT_SERVER, 'SERVER_NAME');
        return match($server){
            '127.0.0.1', 'localhost' => true,
            default => false
        };

    }


    public static function createSlug(string $title): string{

        return strtolower(
            trim(
                preg_replace(
                    '/[^A-Za-z0-9-]+/', '-', $title
                )
            )
                );
    }


    /**
     * Function to validate CPF based on Brazil's IRS algorithm
     * @param string $cpf String of CPF
     * @author Gabriel Chaves Martins
     */

    public static function validateCPF(string $cpf): bool{
        $cpf = self::clearNumber($cpf);
        if (mb_strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)){
            return false;
        }

        for($i = 9; $i < 11; $i++){
            for($j = 0, $k = 0; $k < $i; $k++){
                $j += $cpf[$k] * (($i+1) -$k);
            }

            $j = ((10 * $j) % 11) % 10;

            if($cpf[$k] != $j){
                return false;
            }

        }

        return true;
        
    }


    /**
     * REGEX function to erase any character that isn't numeric
     * @param string $number Number with non numeric characters
     * @return string Formatted Number
     * @author Gabriel Chaves Martins
     */
    public static function clearNumber(string $number): string{
        return preg_replace('/[^0-9]/', '', $number);
    }
}
?>




