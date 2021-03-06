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

namespace ContaoCommunityAlliance\DcGeneral\Test\Contao\Callback;

use ContaoCommunityAlliance\DcGeneral\Contao\Callback\PropertyOnLoadCallbackListener;
use ContaoCommunityAlliance\DcGeneral\DataDefinition\DefaultContainer;
use ContaoCommunityAlliance\DcGeneral\DefaultEnvironment;
use ContaoCommunityAlliance\DcGeneral\Test\TestCase;

class AbstractReturningPropertyCallbackListenerTest extends TestCase
{
    protected function getCallback($value)
    {
        return function () use($value) {
            throw new \Exception('The callback should not be executed as it is only mocked');
        };
    }

    protected function mockEnvironment($dataContainerName)
    {
        $environment = new DefaultEnvironment();
        $environment->setDataDefinition(new DefaultContainer($dataContainerName));

        return $environment;
    }

    protected function mockPropertyEvent($class, $tablename, $propertyName)
    {
        if (method_exists($class, 'getProperty')) {
            $event = $this->getMock(
                $class,
                array('getEnvironment', 'getProperty'),
                array(),
                '',
                false
            );
            $event
                ->expects($this->any())
                ->method('getProperty')
                ->will($this->returnValue($propertyName));
        } else {
            $event = $this->getMock(
                $class,
                array('getEnvironment', 'getPropertyName'),
                array(),
                '',
                false
            );
            $event
                ->expects($this->any())
                ->method('getPropertyName')
                ->will($this->returnValue($propertyName));
        }

        $event
            ->expects($this->any())
            ->method('getEnvironment')
            ->will($this->returnValue($this->mockEnvironment($tablename)));

        return $event;
    }


    public function propertyCallbackDataProvider()
    {
        return array(
            array(
                'ContaoCommunityAlliance\DcGeneral\Contao\Callback\PropertyOnLoadCallbackListener',
                'ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\DecodePropertyValueForWidgetEvent'
            ),
            array(
                'ContaoCommunityAlliance\DcGeneral\Contao\Callback\PropertyOnSaveCallbackListener',
                'ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\EncodePropertyValueFromWidgetEvent'
            ),
            array(
                'ContaoCommunityAlliance\DcGeneral\Contao\Callback\ModelOptionsCallbackListener',
                'ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\GetPropertyOptionsEvent'
            ),
            array(
                'ContaoCommunityAlliance\DcGeneral\Contao\Callback\PropertyInputFieldCallbackListener',
                'ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\BuildWidgetEvent'
            ),
            array(
                'ContaoCommunityAlliance\DcGeneral\Contao\Callback\PropertyInputFieldGetWizardCallbackListener',
                'ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\ManipulateWidgetEvent'
            ),
            array(
                'ContaoCommunityAlliance\DcGeneral\Contao\Callback\PropertyInputFieldGetXLabelCallbackListener',
                'ContaoCommunityAlliance\DcGeneral\Contao\View\Contao2BackendView\Event\ManipulateWidgetEvent'
            ),
        );
    }

    /**
     * @dataProvider propertyCallbackDataProvider
     */
    public function testExecution($listenerClass, $eventClass)
    {
        $listener = new $listenerClass($this->getCallback($listenerClass), array('tablename', 'propertyName'));
        $this->assertTrue(
            $listener->wantToExecute($this->mockPropertyEvent($eventClass, 'tablename', 'propertyName')),
            $listenerClass
        );
        $this->assertFalse(
            $listener->wantToExecute($this->mockPropertyEvent($eventClass, 'anotherTable', 'propertyName')),
            $listenerClass
        );
        $this->assertFalse(
            $listener->wantToExecute($this->mockPropertyEvent($eventClass, 'tablename', 'anotherPropertyName')),
            $listenerClass
        );
    }
}
