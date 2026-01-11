<?php

namespace App\Helpers;

class DocumentHelper
{
    /**
     * Récupère une valeur sauvegardée ou retourne une valeur par défaut
     */
    public static function getValue(array $data, string $key, $default = '')
    {
        return $data[$key] ?? $default;
    }

    /**
     * Vérifie si une option est sélectionnée
     */
    public static function isSelected(array $data, string $key, $value)
    {
        return isset($data[$key]) && $data[$key] === $value;
    }

    /**
     * Retourne 'checked' si la valeur correspond
     */
    public static function checked(array $data, string $key, $value)
    {
        return self::isSelected($data, $key, $value) ? 'checked' : '';
    }

    /**
     * Retourne 'selected' si la valeur correspond
     */
    public static function selected(array $data, string $key, $value)
    {
        return self::isSelected($data, $key, $value) ? 'selected' : '';
    }
}