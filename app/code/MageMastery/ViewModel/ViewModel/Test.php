<?php

namespace MageMastery\ViewModel\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;

class Test implements ArgumentInterface {

    public function getSomething(): string {
        return "Something";
    }

}
