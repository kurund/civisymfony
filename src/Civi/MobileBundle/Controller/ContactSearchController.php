<?php

namespace Civi\MobileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;

use Civi\MobileBundle\Form\Type\ContactSearchForm;

use Civi\MobileBundle\CiviCRM;

class ContactSearchController extends Controller
{
    /**
     * @Route("contact/search", name="contact_search")
     */
    public function searchAction(Request $request)
    {
        $civicrm = new CiviCRM( $this->container->getParameter('settings_path') );
        

        $name = $request->request->get( 'search' );
        $form = $this->createForm( new ContactSearchForm( ) );
        
        $rows = array(); 
        if ( $request->getMethod() == 'POST' ) {
            $result  = \civicrm_api( 'Contact',
                                     'Get',
                                     array( 'version' => 3,
                                            'sort_name' => '%'. $name . '%',                                                                    
                                            'return.display_name' => 1
                                            ) );
            
            $rows = $result['values'];
        }
        
        return $this->render('CiviMobileBundle:Search:search.html.twig',
                              array( 'form' => $form->createView(),
                                     'rows' => $rows ) );
    }
}
