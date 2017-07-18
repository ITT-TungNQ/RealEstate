<?php

class Utils {

    function gen_uuid() {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
                // 32 bits for "time_low"
                mt_rand(0, 0xffff), mt_rand(0, 0xffff),
                // 16 bits for "time_mid"
                mt_rand(0, 0xffff),
                // 16 bits for "time_hi_and_version",
                // four most significant bits holds version number 4
                mt_rand(0, 0x0fff) | 0x4000,
                // 16 bits, 8 bits for "clk_seq_hi_res",
                // 8 bits for "clk_seq_low",
                // two most significant bits holds zero and one for variant DCE1.1
                mt_rand(0, 0x3fff) | 0x8000,
                // 48 bits for "node"
                mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)
        );
    }

    function pwdGenerate() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $specChar = '!@#$%^&*()_+=';
        $randstring = '';
        $lenght = rand(8, 16);
        for ($i = 0; $i < $lenght; $i++) {
            $randstring = $randstring . $characters[rand(0, strlen($characters) - 1)];
        }

        $lenght = rand(2, 4);
        for ($i = 0; $i < $lenght; $i++) {
            $index = rand(0, strlen($randstring));
            $randstring = substr_replace($randstring, $specChar[rand(0, strlen($specChar) - 1)], $index, 1);
        }
        return $randstring;
    }

    function toStringMoney($value) {
        $strMoney = "Thỏa thuận";
        if (is_numeric($value) && $value != 0 && bcmod($value, 1000) == 0) {
            if ($value > 999999999) {
                $value = $value / 1000000000;
                $strMoney = number_format((float) $value, 1, ".", ",");
                $strMoney .= " tỷ";
            } else {
                $value = $value / 1000000;
                $strMoney = number_format((float) $value, 1, ".", ",");
                $strMoney .= " triệu";
            }
        }

        return $strMoney;
    }

    function makeURL($string) {
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );

        $string = trim($string);
        $string = str_replace(' ', '-', $string);

        foreach ($unicode as $nonUnicode => $uni) {
            $string = preg_replace("/($uni)/i", $nonUnicode, $string);
        }
        $string = preg_replace('/[^a-zA-Z0-9-]/i', '', $string);
        $string = strtolower($string);
        return $string;
    }

}

?>