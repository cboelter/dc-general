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

namespace ContaoCommunityAlliance\DcGeneral\View;

use ContaoCommunityAlliance\DcGeneral\Action;
use ContaoCommunityAlliance\DcGeneral\Data\ModelInterface;
use ContaoCommunityAlliance\DcGeneral\EnvironmentInterface;

/**
 * The interface for a view.
 *
 * @package ContaoCommunityAlliance\DcGeneral\View
 */
interface ViewInterface
{
    /**
     * Set the environment.
     *
     * @param EnvironmentInterface $environment The environment.
     *
     * @return ViewInterface
     */
    public function setEnvironment(EnvironmentInterface $environment);

    /**
     * Retrieve the attached environment.
     *
     * @return EnvironmentInterface
     */
    public function getEnvironment();

    /**
     * Handle an ajax request.
     *
     * @return void
     */
    public function handleAjaxCall();

    /**
     * Invoked for cut and copy - inserts the content of the clipboard at the given position.
     *
     * @param Action $action The action being executed.
     *
     * @return void
     */
    public function paste(Action $action);

    /**
     * Endpoint for create operation.
     *
     * @param Action $action The action being executed.
     *
     * @return string
     */
    public function create(Action $action);

    /**
     * Delete a model and redirect the user to the listing.
     *
     * NOTE: This method redirects the user to the listing and therefore the script will be ended.
     *
     * @param Action $action The action being executed.
     *
     * @return void
     */
    public function delete(Action $action);

    /**
     * Endpoint for edit operation.
     *
     * @param Action $action The action being executed.
     *
     * @return string
     */
    public function edit(Action $action);

    /**
     * Endpoint for move operation.
     *
     * @param Action $action The action being executed.
     *
     * @return string
     */
    public function move(Action $action);

    /**
     * Overview listing over all items in the current scope.
     *
     * This is the default action to perform if no other action has been specified in the URL.
     *
     * @param Action $action The action being executed.
     *
     * @return string
     */
    public function showAll(Action $action);

    /**
     * Endpoint for undo operation.
     *
     * @param Action $action The action being executed.
     *
     * @return string
     */
    public function undo(Action $action);

    /**
     * Abstract method to be overridden in the certain child classes.
     *
     * This method will update the parent relationship between a model and the parent item.
     *
     * @param ModelInterface $model The model to be updated.
     *
     * @return void
     */
    public function enforceModelRelationship($model);
}
