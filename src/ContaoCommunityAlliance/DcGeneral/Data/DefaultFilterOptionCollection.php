<?php
/**
 * PHP version 5
 *
 * @package    generalDriver
 * @author     Christian Schiffler <c.schiffler@cyberspectrum.de>
 * @author     Stefan Heimes <stefan_heimes@hotmail.com>
 * @author     Tristan Lins <tristan.lins@bit3.de>
 * @copyright  The MetaModels team.
 * @license    LGPL.
 * @filesource
 */

namespace ContaoCommunityAlliance\DcGeneral\Data;

/**
 * This class is the base implementation for LanguageInformationCollectionInterface.
 *
 * @package DcGeneral\Data
 */
class DefaultFilterOptionCollection implements FilterOptionCollectionInterface
{
    /**
     * The language information stored in this collection.
     *
     * @var array
     */
    protected $filterValues = array();

    /**
     * {@inheritDoc}
     */
    public function add($filterKey, $filterValue)
    {
        $this->filterValues[$filterKey] = $filterValue;

        return $this;
    }

    /**
     * Get a iterator for this collection.
     *
     * @return \IteratorAggregate
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->filterValues);
    }

    /**
     * Count the contained language information.
     *
     * @return int
     */
    public function count()
    {
        return count($this->filterValues);
    }
}
