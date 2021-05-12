<?php

namespace Drawing;

use ReflectionClass;

trait JsonFormatter
{
    public function jsonSerialize()
    {
        // Donne des informations sur l'instance qui a été passée en paramètre
        $reflection = new ReflectionClass($this);
        
        // Liste des propriétés de la classe et de leur valeur
        $properties = [];
        
        // Ajout du nom de la classe dans les propriétés
        $properties['class'] = self::class;
        
        // Parcours de toutes les propriétés de la classe
        foreach ($reflection->getProperties() as $property) {
            $attribute = $property->getName();
            $properties['properties'][$attribute] = $this->$attribute;
        }
        
        return $properties;
    }
}