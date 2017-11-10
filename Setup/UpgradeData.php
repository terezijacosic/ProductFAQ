<?php

namespace Inchoo\ProductFAQ\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;

/**
 * Upgrade Data script
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class UpgradeData implements UpgradeDataInterface
{
    protected $faqResource;
    protected $faqModelFactory;


    public function __construct(
        \Inchoo\ProductFAQ\Model\ResourceModel\Faqs $faqResource,
        \Inchoo\ProductFAQ\Model\FaqsFactory $faqModelFactory
    )
    {
        $this->faqResource = $faqResource;
        $this->faqModelFactory = $faqModelFactory;
    }


    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {

//        $setup->startSetup();
//
//        if (version_compare($context->getVersion(), '1.0.3') < 0) {
//            /**
//             * New entry example
//             */
//            for ($i=3; $i<21; $i++){
//
//                $faq = $this->faqModelFactory->create();
//                $faq->setQuestion('Question no' . $i);
//                $faq->setContent('Some faq content fo title no' . $i);
//
//                $this->faqResource->save($faq);
//
//                //var_dump($faq); //big dump, can crash browser without xdebug
//                //var_dump($faq->debug());
//                echo "Dodali smo vijest $i ?";
//            }
//        }
//
//
//
//        $setup->endSetup();
    }
}