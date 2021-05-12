<?php

namespace Drawing\Shapes;

abstract class Shape
{
    protected int $x;
    protected int $y;
    protected string $color;
    protected float $opacity;

    /**
     * Shape constructor.
     * @param int $x
     * @param int $y
     * @param string $color
     * @param float $opacity
     */
    // public function __construct(int $x, int $y, string $color, float $opacity)
    // {
    //     $this->x = $x;
    //     $this->y = $y;
    //     $this->color = $color;
    //     $this->opacity = $opacity;
    // }
    
    public abstract function draw(string $type): string;

    /**
     * @return int
     */
    public function getX(): int
    {
        return $this->x;
    }

    /**
     * @param int $x
     */
    public function setX(int $x): void
    {
        $this->x = $x;
    }

    /**
     * @return int
     */
    public function getY(): int
    {
        return $this->y;
    }

    /**
     * @param int $y
     */
    public function setY(int $y): void
    {
        $this->y = $y;
    }

    /**
     * @return string
     */
    public function getColor(): string
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor(string $color): void
    {
        $this->color = $color;
    }

    /**
     * @return float
     */
    public function getOpacity(): float
    {
        return $this->opacity;
    }

    /**
     * @param float $opacity
     */
    public function setOpacity(float $opacity): void
    {
        $this->opacity = $opacity;
    }
}