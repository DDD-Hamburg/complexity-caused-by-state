<?php
declare(strict_types=1);

class Item {
    private $quantity;
    private $description;
    private $id;
    private $pricePerUnity;

    public function __construct(int $quantity, string $description, string $id, float $pricePerUnity) {
        $this->quantity = $quantity;
        $this->description = $description;
        $this->id = $id;
        $this->pricePerUnity = $pricePerUnity;
    }

    public function getQuantity() : int {
        return $this->quantity;
    }

    public function getDescription() : string {
        return $this->description;
    }

    public function getId() : string {
        return $this->id;
    }

    public function getPricePerUnity() : float {
        return $this->pricePerUnity;
    }
}
