<?php

namespace BG\CoreBundle\Twig\Extension;

class IndexExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('index', array($this, 'indexFilter')),
        );
    }

    /**
     * Convert grade to index.
     *
     * @return string
     */
    public function indexFilter($value)
    {
        $quot = intval($value/26);
        $rem = intval($value%26);
        $letter = chr((ord('A') + $rem));

        return $quot == 0 ? $letter : $this->indexFilter($quot-1).$letter;
    }
}