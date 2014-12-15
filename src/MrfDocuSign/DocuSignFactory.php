<?php
namespace MrfDocuSign;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class DocuSignFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface $serviceLocator
     * @return \DocuSign_Client|void
     * @throws \RuntimeException
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');

        if (!array_key_exists('docusign', $config)) {
            throw new \RuntimeException('No docusign config entry');
        }

        $docusign = new \DocuSign_Client($config['docusign']);
        if ($docusign->hasError()) {
            throw new \RuntimeException($docusign->getErrorMessage());
        }

        return $docusign;
    }

}