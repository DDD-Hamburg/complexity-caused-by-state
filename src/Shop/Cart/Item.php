<?php

namespace DDDHH\Shop\Cart;

class Item
{
    /** @var string */
    private $id;

    /** @var string */
    private $desc;

    /** @var float */
    private $ppu;

    /** @var int */
    private $qty;

    /**
     * @param string $id Unique Id
     * @param string $desc Description
     * @param float $ppu Price per unit
     * @param int $qty Quantity
     */
    public function __construct(string $id, string $desc, float $ppu, int $qty)
    {
        $this->id = $id;
        $this->desc = $desc;
        $this->ppu = $ppu;
        $this->qty = $qty;
    }

    public function id(): string
    {
        return $this->id;
    }

    public function description(): string
    {
        return $this->desc;
    }

    public function pricePerUnit(): float
    {
        return $this->ppu;
    }

    public function quantity(): int
    {
        return $this->qty;
    }

    /**
     * @return array
     */
    public function toArray() {
        return [
            'itemId' => $this->id(),
            'desc' => $this->description(),
            'pricePerUnit' => $this->pricePerUnit(),
            'quantity' => $this->quantity(),
        ];
    }

}
