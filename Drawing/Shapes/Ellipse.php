<?php

namespace Drawing\Shapes;

use JsonSerializable;
use Drawing\JsonFormatter;

class Ellipse extends Shape implements JsonSerializable
{
    use JsonFormatter;
    
    protected int $rx;
    protected int $ry;

    // public function __construct(int $x, int $y, string $color, float $opacity, int $rx, int $ry)
    // {
    //     parent::__construct($x, $y, $color, $opacity);
    //     $this->rx = $rx;
    //     $this->ry = $ry;
    // }
    
    public function draw(string $type): string
    {
        switch ($type) {
            case 'svg':
                return sprintf('<ellipse cx="%s" cy="%s" rx="%s" ry="%s" fill="%s" opacity="%s"></ellipse>', 
                    $this->x,
                    $this->y,
                    $this->rx,
                    $this->ry,
                    $this->color,
                    $this->opacity
                );
            case 'css':
                $width = $this->rx * 2;
                $height = $this->ry * 2;
                $relativeX = $this->x - $this->rx;
                $relativeY = $this->y - $this->ry;
        
                return sprintf('<div style="position:relative;left:%spx;top:%spx;width:%spx;height:%spx;border-radius:%spx / %spx;background-color:%s;opacity:%s"></div>',
                    $relativeX, $relativeY, $width, $height, $this->rx, $this->ry, $this->color, $this->opacity
                );
        }
    }
    
    /**
     * @return int
     */
    public function getRx(): int
    {
        return $this->rx;
    }

    /**
     * @param int $rx
     */
    public function setRx(int $rx): void
    {
        $this->rx = $rx;
    }

    /**
     * @return int
     */
    public function getRy(): int
    {
        return $this->ry;
    }

    /**
     * @param int $ry
     */
    public function setRy(int $ry): void
    {
        $this->ry = $ry;
    }
}