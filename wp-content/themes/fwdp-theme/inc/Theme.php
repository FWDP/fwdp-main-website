<?php
namespace FWDP;

use FWDP\Core\{Setup, Enqueue, PostTypes, Pages, Customizer, Navigation};
use FWDP\Interfaces\Hookable;

class Theme {
    private $modules = [];

    public function init() {
        $this->register_modules();
    }

    private function register_modules() {
        $this->modules = [
            new Setup(),
            new Enqueue(),
            new PostTypes(),
            new Pages(),
            new Customizer(),
            new Navigation()
        ];

        foreach ($this->modules as $module) {
            if ($module instanceof Hookable) {
                $module->register();
            }
        }
    }
}
