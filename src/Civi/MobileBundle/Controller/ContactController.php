<?php

namespace Civi\MobileBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Symfony\Component\HttpFoundation\Request;

use Civi\MobileBundle\Entity\Contact;
use Civi\MobileBundle\Form\Type\ContactForm;

use Civi\MobileBundle\CiviCRM;

class ContactController extends Controller
{
    /**
     * @Route("contact/new/{id}", name="contact_edit", requirements={"id" = "\d+"}, defaults={"id" = 0} )
     */
    public function newAction(Request $request, $id)
    {
        $contact = new Contact( );

        $civicrm = new CiviCRM( $this->container->getParameter('settings_path') );
        //print_r($civicrm);
        $contactID = $id;
        
        if ( ! $contactID ) {
            $postData = $request->request->get( 'contact' );
            if ( $postData ) {
                $contactID = $postData['contactID'];
            }
        }

        if ( $contactID ) {
            $result  = \civicrm_api( 'Contact',
                                     'GetSingle',
                                     array( 'version' => 3,
                                            'id' => $contactID,
                                            'return.first_name' => 1,
                                            'return.last_name'  => 1 ) );
            $contact->setContactID( $contactID );
            $contact->setFirstName( $result['first_name'] );
            $contact->setLastName ( $result['last_name'] );
        }

        $form = $this->createForm( new ContactForm( ), $contact );

        if ($request->getMethod() == 'POST') {
            $form->bindRequest($request);

            if ($form->isValid()) {
                // perform some action, such as saving the task to the database
                $op = 'Create';
                if ( $contactID ) {
                    $op = 'Update';
                }
                 
                $result = \civicrm_api( 'Contact',
                                        $op,
                                        array( 'version' => 3,
                                               'id' => $contactID,
                                               'contact_type' => 'Individual',
                                               'first_name' => $contact->getFirstName( ),
                                               'last_name'  => $contact->getLastName( ) ) );

                return $this->redirect( $this
                                        ->get('router')
                                        ->generate('contact_view',
                                                   array( 'id' => $result['id'] ) ) );
            }
        } else {
            return $this->render('CiviMobileBundle:Contact:new.html.twig', array(
                                                                                 'form' => $form->createView(),
                                                                                ));
        }
    }

    /**
     * @Route("contact/view/{id}", name="contact_view", requirements={"id" = "\d+"})
     */
    public function viewAction( Request $request, $id )
    {
        $contact = new Contact( );

        $civicrm = new CiviCRM( $this->container->getParameter('settings_path') );

        $templateVars = array( 'id' => $id );

        $result = \civicrm_api( 'Contact',
                                'GetSingle',
                                array( 'version' => 3,
                                       'id' => $id ) );
        
        $templateVars['contact_type'] = $result['contact_type'];
        $templateVars['display_name'] = $result['display_name'];
        $templateVars['image_URL'] = $result['image_URL'];
        $templateVars['first_name'] = $result['first_name'];
        $templateVars['last_name' ] = $result['last_name'];
        
        return $this->render('CiviMobileBundle:Contact:index.html.twig',
                             $templateVars );
    }
    
}
