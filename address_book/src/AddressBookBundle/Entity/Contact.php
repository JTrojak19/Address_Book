<?php

namespace AddressBookBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact")
 * @ORM\Entity(repositoryClass="AddressBookBundle\Repository\ContactRepository")
 */
class Contact
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    /**
     *@var int
     * @ORM\OneToMany(targetEntity="Address", mappedBy="contact_id")
     */
    private $address_id; 

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
     * Set name
     *
     * @param string $name
     * @return Contact
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return Contact
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Contact
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->address_id = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add address_id
     *
     * @param \AddressBookBundle\Entity\Address $addressId
     * @return Contact
     */
    public function addAddressId(\AddressBookBundle\Entity\Address $addressId)
    {
        $this->address_id[] = $addressId;

        return $this;
    }

    /**
     * Remove address_id
     *
     * @param \AddressBookBundle\Entity\Address $addressId
     */
    public function removeAddressId(\AddressBookBundle\Entity\Address $addressId)
    {
        $this->address_id->removeElement($addressId);
    }

    /**
     * Get address_id
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAddressId()
    {
        return $this->address_id;
    }
}
