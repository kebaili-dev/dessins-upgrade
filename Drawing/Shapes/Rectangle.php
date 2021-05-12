<?php

namespace Drawing\Shapes;

use JsonSerializable;
use Drawing\JsonFormatter;

class Rectangle extends Shape implements JsonSerializable
{
    use JsonFormatter;
    
    protected int $width;
    protected int $height;
    
    /**
     * Rectangle constructor.
     * @param int $x
     * @param int $y
     * @param string $color
     * @param float $opacity
     * @param int $width
     * @param int $height
     */
    // public function __construct(int $x, int $y, string $color, float $opacity, int $width, int $height)
    // {
    //     parent::__construct($x, $y, $color, $opacity);
    //     $this->width = $width;
    //     $this->height = $height;
    // }
    
    public function draw(string $type): string
    {
        switch ($type) {
            case 'svg':
                return $this->drawSvg();
            case 'css':
                return $this->drawCss();
        }
    }
    
    public function drawSvg(): string
    {
        return sprintf('<rect x="%s" y="%s" width="%s" height="%s" fill="%s" opacity="%s"></rect>',
            $this->x,
            $this->y,
            $this->width,
            $this->height,
            $this->color,
            $this->opacity
        );
    }
    
    public function drawCss(): string
    {
        return sprintf('<div style="position:absolute;left:%spx;top:%spx;width:%spx;height:%spx;background-color:%s;opacity:%s"></div>', 
            $this->x, 
            $this->y, 
            $this->width, 
            $this->height, 
            $this->color, 
            $this->opacity
        );
    }
    
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
}