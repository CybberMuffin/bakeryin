<?php

function output($template, $dataArr = [], $count = null)
{
    $filename = __DIR__ . '\templates\\' .$template.'.php';
    extract($dataArr, EXTR_SKIP);
    ob_start();
    parsing($filename, $template);
    require 'parsed_templates\parsed_'.$template.'.php';
    return ob_get_clean();
}

function parsing($file, $template)
{
    $main_file = fopen($file, 'r');
    $newfile = fopen(__DIR__ . '\parsed_templates\parsed_' .$template.'.php', 'w');

    while(!feof($main_file))
    {
        $buffer = fgets($main_file);
        if(strpos($buffer, '@') !== false)
        {
            $buffer = str_replace('@', '<?php', $buffer);
            $buffer .= '?>';
        }
        if(strpos($buffer, '{{') !== false && strpos($buffer, '}}') !== false)
        {
            $buffer = str_replace('{{', '<?=', $buffer);
            $buffer = str_replace('}}', '?>', $buffer);
        }
        fwrite($newfile, $buffer);
    }

    fclose($main_file);
    fclose($newfile);
}
