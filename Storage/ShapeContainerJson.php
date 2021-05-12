<?php

namespace Storage;

use Drawing\Containers\ShapeContainer;

class ShapeContainerJson
{
    protected string $filename;
    
    public function __construct(string $filename)
    {
        $this->filename = $filename;
    }
    
    public function load(): ?ShapeContainer
    {
        $json = json_decode(file_get_contents($this->filename), true);
        
        if ($json === null) {
            return null;
        }
        
        // On recrée la classe Container depuis le fichier json
        $container = new ShapeContainer($json['width'], $json['height'], $json['type']);
        
        // On va recréer les classes Shape depuis le fichier json
        foreach ($json['shapes'] as $shape) {
            $className = $shape['class'];
            
            // Récupère la classe Shape correspondante
            // => Instancie un Rectangle ou une Ellipse
            $instance = new $className();
            
            foreach ($shape['properties'] as $property => $value) {
                // Création du nom de la méthode dynamiquement
                $method = 'set' . ucfirst($property);
                
                // Pour chaque propriété on appelle le setter correspondant
                // setWidth, setHeight...
                $instance->$method($value);
            }
            
            // On ajoute la forme créée (l'instance de la classe Shape qui a été créée)
            // à notre instance de la classe ShapeContainer
            $container->addShape($instance);
        }
        
        return $container;
    }
    
    public function save(ShapeContainer $container): void
    {
        $json = json_encode($container);
        file_put_contents($this->filename, $json);
    }
}