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

namespace ContaoCommunityAlliance\DcGeneral\DataDefinition\Definition\View;

use ContaoCommunityAlliance\DcGeneral\Exception\DcGeneralInvalidArgumentException;

/**
 * This class defines a collection of grouping and sorting information for the view.
 */
class DefaultGroupAndSortingDefinitionCollection implements GroupAndSortingDefinitionCollectionInterface
{
    /**
     * The information stored.
     *
     * @var GroupAndSortingDefinitionInterface[]
     */
    protected $information = array();

    /**
     * Index of the default information.
     *
     * @var int
     */
    protected $default = -1;

    /**
     * {@inheritDoc}
     */
    public function add($index = -1)
    {
        $information = new DefaultGroupAndSortingDefinition();
        $information->setName('Information ' . ($this->getCount() + 1));

        if (($index < 0) || ($this->getCount() <= $index)) {
            $this->information[] = $information;
        } else {
            array_splice($this->information, $index, 0, array($information));
        }

        return $information;
    }

    /**
     * {@inheritDoc}
     */
    public function delete($index)
    {
        if ($index == $this->default) {
            $this->default = -1;
        }
        unset($this->information[$index]);
        $this->information = array_values($this->information);

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getCount()
    {
        return count($this->information);
    }

    /**
     * {@inheritDoc}
     *
     * @throws DcGeneralInvalidArgumentException When the offset does not exist.
     */
    public function get($index = -1)
    {
        if ($index == -1) {
            return $this->getDefault();
        }

        if (!isset($this->information[$index])) {
            throw new DcGeneralInvalidArgumentException('Offset ' . $index . ' does not exist.');
        }

        return $this->information[$index];
    }

    /**
     * {@inheritDoc}
     *
     * @throws DcGeneralInvalidArgumentException When the information is neither a proper instance nor an integer.
     */
    public function markDefault($information)
    {
        if ($information instanceof GroupAndSortingDefinitionInterface) {
            $information = array_search($information, $this->information);
        }

        if (!is_int($information)) {
            throw new DcGeneralInvalidArgumentException('Invalid argument.');
        }

        $this->default = $information;
    }

    /**
     * {@inheritDoc}
     */
    public function hasDefault()
    {
        return ($this->getDefaultIndex() != -1);
    }

    /**
     * {@inheritDoc}
     *
     * @throws DcGeneralInvalidArgumentException When no default has been defined.
     */
    public function getDefault()
    {
        $index = $this->getDefaultIndex();
        if ($index == -1) {
            throw new DcGeneralInvalidArgumentException('No default sorting and grouping information defined.');
        }

        return $this->get($index);
    }

    /**
     * {@inheritDoc}
     */
    public function getDefaultIndex()
    {
        return $this->default;
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->information);
    }
}
