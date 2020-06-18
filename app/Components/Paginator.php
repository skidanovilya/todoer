<?php

namespace TorjaPHP\Components;

class Paginator {
    const ORDER_DESC = TRUE;
    const ORDER_ASC  = FALSE;

    private $elements;
    private $elements_on_page;
    private $page_count;

    public function __construct($elements, $elements_on_page = NULL) {
        $this->elements = $elements;
        $this->elements_on_page = !$elements_on_page ? \count($this->elements) : $elements_on_page;

        $this->page_count = ceil(count($this->elements) / $elements_on_page);
    }

    public function sort($property, $desc = FALSE) {
        usort( $this->elements, function($a, $b) use($property, $desc) {
            return (-1) ** $desc * strcmp($a->$property, $b->$property);
        });
    }

    public function get() {
        return $this->elements;
    }

    public function paginate($page) {
        $chunks = array_chunk($this->elements, $this->elements_on_page);

        if ($chunks) {
            $this->elements = $chunks[$page-1];
        }
    }

    public function getLastPage() {
        return $this->page_count;
    }
}