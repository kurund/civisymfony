<?php

namespace Civi\MobileBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Civi\MobileBundle\Entity\Contact
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Civi\MobileBundle\Entity\ContactRepository")
 */
class Contact
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var integer $contactID
     *
     * @ORM\Column(name="contactID", type="integer")
     */
    private $contactID;

    /**
     * @var string $firstName
     *
     * @ORM\Column(name="firstName", type="string", length=64)
     */
    private $firstName;

    /**
     * @var string $lastName
     *
     * @ORM\Column(name="lastName", type="string", length=64)
     */
    private $lastName;

    /**
     * @var string $middleName
     *
     * @ORM\Column(name="middleName", type="string", length=64)
     */
    private $middleName;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set contactID
     *
     * @param integer $contactID
     */
    public function setContactID($contactID)
    {
        $this->contactID = $contactID;
    }

    /**
     * Get contactID
     *
     * @return integer 
     */
    public function getContactID()
    {
        return $this->contactID;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set middleName
     *
     * @param string $middleName
     */
    public function setMiddleName($middleName)
    {
        $this->middleName = $middleName;
    }

    /**
     * Get middleName
     *
     * @return string 
     */
    public function getMiddleName()
    {
        return $this->middleName;
    }
}