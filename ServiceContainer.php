<?php
declare(strict_types=1);

/**
 * This class simulates traditionl way of implementing our services to inject in our classes
 * Class ServiceContainer
 */
class ServiceContainer {
    private $calculatorService = null;

    public function getCalculatorService() : CalculatorService {
        if (!$this->calculatorService) {
            $this->calculatorService = new CalculatorService();
        }
        return $this->calculatorService;
    }
}
