<?php
namespace MrfDocuSignTest;

use PHPUnit_Framework_TestCase;
use Zend\ServiceManager\ServiceManager;
use MrfDocuSign\DocuSignFactory;

class DocuSignFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testCreateServiceWithNoConfigSet()
    {
        $serviceLocator = new ServiceManager();
        $docusignFactory = new DocuSignFactory();

        $serviceLocator->setService('Config', array());

        try {
            $docusign = $docusignFactory->createService($serviceLocator);
        }catch (\Exception $e) {
            $this->assertThat($e->getMessage(), new \PHPUnit_Framework_Constraint_IsEqual('No docusign config entry'));
        }
    }

    public function testCreateServiceWithBadConfigSet()
    {
        $serviceLocator = new ServiceManager();
        $docusignFactory = new DocuSignFactory();

        $serviceLocator->setService('Config', array(
            'docusign' => array(
                'rawr' => 'foo'
            )
        ));

        try {
            $docusignFactory->createService($serviceLocator);
        }catch (\Exception $e) {
            $this->assertThat($e->getMessage(), new \PHPUnit_Framework_Constraint_PCREMatch('/^Undefined index:/'));
        }
    }

}