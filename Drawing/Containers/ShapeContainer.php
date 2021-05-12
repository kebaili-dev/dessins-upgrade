<?php

namespace Drawing\Containers;

use Drawing\Shapes\Shape;
use JsonSerializable;
use ReflectionClass;
use Drawing\JsonFormatter;

// On implémente l'interface native à php JsonSerializable
// => On doit redéfinir la méthode jsonSerialize
class ShapeContainer implements JsonSerializable
{
    // Utilise le trait JsonFormatter
    use JsonFormatter;
    
    protected int $width;
    protected int $height;
    protected string $type;
    protected array $shapes;
    
    public function __construct(int $width, int $height, string $type, array $shapes = [])
    {
        $this->width = $width;
        $this->height = $height;
        $this->type = $type;
        $this->shapes = $shapes;
    }
    
    public function addShape(Shape $shape): ShapeContainer
    {
        $this->shapes[] = $shape;
        
        // On renvoie la classe ShapeContainer pour pouvoir chaîner les appels de la fonction addShape
        return $this;
    }
    
    public function render(): string
    {
        switch ($this->type) {
            case 'css':
                $element = 'div';
                break;
            case 'svg':
                $element = 'svg';
                break;
        }
        
        // Ouverture de la balise SVG
        $svg = sprintf('<%s width="%s" height="%s">', $element, $this->width, $this->height);
        
        // Ajout du texte de chacune des formes dans le svg
        foreach ($this->shapes as $shape) {
            $svg .= $shape->draw($this->type);
        }
        
        // Fermeture de la balise
        $svg .= "</$element>";
        
        return $svg;
    }
    
    // Méthode de l'interface JsonSerializable qu'on doit redéfinir
    // Elle indique ce que doit renvoyer la fonction json_encode quand on passe cette classe en paramètre
    // public function jsonSerialize()
    // {
    //     // return [
    //     //     'type' => $this->type,
    //     //     'width' => $this->width,
    //     //     'height' => $this->height,
    //     //     'shapes' => $this->shapes
    //     // ];
        
    //     // Donne des informations sur l'instance qui a été passée en paramètre
    //     $reflection = new ReflectionClass($this);
        
    //     // Liste des propriétés de la classe et de leur valeur
    //     $properties = [];
        
    //     foreach ($reflection->getProperties() as $property) {
    //         $attribute = $property->getName();
    //         $properties[$attribute] = $this->$attribute;
    //     }
        
    //     return $properties;
    // }
    
    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    /**
     * @param int $width
     */
    public function setWidth(int $width): void
    {
        $this->width = $width;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @param int $height
     */
    public function setHeight(int $height): void
    {
        $this->height = $height;
    }
    
    /**
     * @return array
     */
    public function getShapes(): array
    {
        return $this->shapes;
    }

    /**
     * @param array $shapes
     */
    public function setShapes(array $shapes): void
    {
        $this->shapes = $shapes;
    }
}