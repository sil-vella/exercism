<?php

function language_list(...$languages)
{
    return $languages;
}

function add_to_language_list($language_list, ...$languages)
{
    return array_merge($language_list, $languages);
}

function prune_language_list($language_list)
    {
        array_shift($language_list);
        return $language_list; 
    }

function current_language($language_list)
    {
        return $language_list[0];
    }
function language_list_length($language_list)
    {
        return count($language_list);
    }