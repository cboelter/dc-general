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

namespace ContaoCommunityAlliance\DcGeneral\Contao\Callback;

use ContaoCommunityAlliance\DcGeneral\Contao\Compatibility\DcCompat;
use ContaoCommunityAlliance\DcGeneral\Event\PostDuplicateModelEvent;

/**
 * Class ContainerOnCopyCallbackListener.
 *
 * Handle callbacks to be invoked when a copy operation is made.
 *
 * @package DcGeneral\Contao\Callback
 */
class ContainerOnCopyCallbackListener extends AbstractCallbackListener
{
    /**
     * Retrieve the arguments for the callback.
     *
     * @param PostDuplicateModelEvent $event The event being emitted.
     *
     * @return array
     */
    public function getArgs($event)
    {
        return array($event->getModel()->getId(), new DcCompat($event->getEnvironment(), $event->getSourceModel()));
    }
}
