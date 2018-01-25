<?php
require_once 'abstract.php';
class Gide_Shell_Task extends Mage_Shell_Abstract
{
    public function run()
    {
        error_reporting(0);
        ini_set('display_errors', '0');
        ini_set('memory_limit', '-1');

        if ($this->_args['file']) {
            $file       =   $this->_args['file'];
            $content    =   file_get_contents($file);
            $productIds =   explode(",",$content );
            $collection =   $this->getProductCollection( $productIds );
            $enable     =   $disable = $category = $image = "";
            $categories = $images = $status = array();
            foreach( $collection as $product ){

                if( $product->getStatus() )
                    $enable .= $product->getId().",";
                else
                    $disable .= $product->getId().",";

                /* Get Categories Count */
                $categories['categories'][$product->getId()]    =   count( $product->getCategoryIds() ) ;
                /* Get Images Count */
                $images['images'][$product->getId()]            =   $this->getMediaGallery( $product->getId() ) ;
            }

            $status['status']['enabled']    = rtrim( $enable,',') ;
            $status['status']['disabled']   = rtrim($disable,',') ;

            print_r( $status );
            print_r( $images );
            print_r( $categories );
        }
    }

    /**
     * Get Product Collection.
     */
    public function getProductCollection( $productIds = array() ){
        $collection = Mage::getModel('catalog/product')
            ->getCollection()
            ->addAttributeToSelect('category_ids')
            ->addAttributeToSelect('status')
            ->addAttributeToFilter('entity_id', array('in' => $productIds));
        return $collection;
    }

    /**
     * Getting Media Gallery.
     */
    public function getMediaGallery( $id ){
        $_images = Mage::getModel('catalog/product')->load( $id )->getMediaGalleryImages();
        return $_images->count();
    }

    public function usageHelp()
    {
        return <<<USAGE
Usage:  php  shell/task.php -- [options]
  --file name.txt

USAGE;
    }
}

$shell = new Gide_Shell_Task();
$shell->run();