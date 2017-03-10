<?php
namespace AppBundle\Twig;
class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('somme', array($this, 'sommeFilter')),    
           new \Twig_SimpleFilter('percent', array($this, 'percentFilter')),
            new \Twig_SimpleFilter('count', array($this, 'countFilter')),
        );
    }

    public function sommeFilter($list, $attr,$default=0)
    {
        $somme=$default;
       foreach ($list as  $value) {
           $somme+=$value[$attr];
       }

        return $somme;
    }

    public function countFilter($list, $attr)
    {
        $count=0;
       foreach ($list as  $value) {
        if($value[$attr])
           $somme+=1;
       }

        return $count;
    }

      public function percentFilter($list, $attr)
    {
        $somme=0;
       foreach ($list as  $value) {
        if($value[$attr])
           $somme+=1;
       }
        return count($list)>0?$somme/count($list):0;
    }  
}