<?php

namespace Rcore\Helpers;

class Html
{
    public static function email($email)
    {
        $character_set = '+-.0123456789@ABCDEFGHIJKLMNOPQRSTUVWXYZ_abcdefghijklmnopqrstuvwxyz';

        $key = str_shuffle($character_set);
        $cipher_text = '';
        $id = 'e' . rand(1, 999999999);
        $length = strlen($email);

        for ($i = 0; $i < $length; $i++) {
            $cipher_text .= $key[strpos($character_set, $email[$i])];
        }

        $script = 'var a="' . $key . '";var b=a.split("").sort().join("");var c="' . $cipher_text . '";var d="";';

        $script .= 'for(var e=0;e<c.length;e++)d+=b.charAt(a.indexOf(c.charAt(e)));';

        $script .= 'document.getElementById("' . $id . '").innerHTML="<a href=\\"mailto:"+d+"\\">"+d+"</a>"';

        $script = 'eval("' . str_replace(['\\', '"'], ['\\\\', '\"'], $script) . '")';

        $script = '<script type="text/javascript">/*<![CDATA[*/' . $script . '/*]]>*/</script>';

        return '<span id="' . $id . '">[javascript protected email address]</span>' . $script;
    }

    public static function phone($phone, $class = '')
    {
        return '<a class="' . $class . '" href="tel:' . str_replace(' ', '', $phone) . '">' . $phone . '</a>';
    }
}
