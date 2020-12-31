<?php

if (! function_exists('camelToWords')) {

    function camelToWords($camelStr)
    {
        $words = preg_replace('/(?<!\ )[A-Z]/', ' $0', $camelStr);
        return $words;
    }


}
if (! function_exists('singularTitle')) {

    function singularTitle($word)
    {
        return ucfirst(Str::singular(camelToWords($word)));
    }

    
}
if (! function_exists('singularDatatype')) {

    function singularDatatype($dataType)
    {
        return lcfirst(Str::singular($dataType));
    }

    
}
if (! function_exists('pluralTitle')) {

    function pluralTitle($word)
    {
        return ucfirst(Str::plural(camelToWords($word)));
    }

    
}

if (! function_exists('pluralDatatype')) {

    function pluralDatatype($dataType)
    {
        return lcfirst(Str::plural($dataType));
    }

    
}
if (! function_exists('get_route')) {

    function get_route($model,$verb)
    {
        return Str::of($model)->plural()->lower().".".$verb;
    }

    
}