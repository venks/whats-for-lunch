<?php
/**
 *
 */

namespace AppBundle\Tests;

use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Input\StringInput;

/**
 * Base Test Case that boots the application kernel and initialises the service container
 *
 */
class BaseTestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * Handle for Service Container
     *
     * @var ContainerInterface
     */
    protected $container;

    /**
    * Handle for Symfony Console Application
    *
    * @var Application
    */
    protected $application;

    /**
     * Constructor
     */
    public function __construct()
    {
        $kernel = new \AppKernel("test", true);
        $kernel->boot();
        $this->container = $kernel->getContainer();
        parent::__construct();
    }


    /**
     * Get a service from container
     *
     * @param string $service Service name / alias
     *
     * @return Service
     */
    protected function get($service)
    {
        return $this->container->get($service);
    }


    /**
     * Unit test setup
     *
     * @return void
     */
    protected function setUp()
    {
    }

    /**
     * Runs given console command
     *
     * @param string $command Command name
     *
     * @return int 0 if everything went fine, or an error code
     */
    protected function runCommand($command)
    {
        $command = sprintf('%s --quiet', $command);

        return $this->getApplication()->run(new StringInput($command));
    }

    /**
     * Returns Symfony console application instantiating it if one does not exist.
     *
     * @return Application
     */
    protected function getApplication()
    {
        if ($this->application === null) {
            $this->application = new Application($this->get('kernel'));
            $this->application->setAutoExit(false);
        }

        return $this->application;
    }
}
