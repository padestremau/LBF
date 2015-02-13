<?php

namespace LBF\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Email
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LBF\UserBundle\Entity\EmailRepository")
 */
class Email
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="object", type="string", length=255)
     */
    private $object;

    /**
     * @var string
     *
     * @ORM\Column(name="recipientName", type="string", length=255)
     */
    private $recipientName;

    /**
     * @var string
     *
     * @ORM\Column(name="recipientEmail", type="string", length=255)
     */
    private $recipientEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sentAt", type="datetime")
     */
    private $sentAt;

    /*   *********      construct  *************  */

    public function __construct()
    {
        $this->sentAt         = new \Datetime;
    }

    /*   *********     Setter and getter Functions  *************  */


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
     * Set object
     *
     * @param string $object
     * @return Email
     */
    public function setObject($object)
    {
        $this->object = $object;

        return $this;
    }

    /**
     * Get object
     *
     * @return string 
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * Set recipientName
     *
     * @param string $recipientName
     * @return Email
     */
    public function setRecipientName($recipientName)
    {
        $this->recipientName = $recipientName;

        return $this;
    }

    /**
     * Get recipientName
     *
     * @return string 
     */
    public function getRecipientName()
    {
        return $this->recipientName;
    }

    /**
     * Set recipientEmail
     *
     * @param string $recipientEmail
     * @return Email
     */
    public function setRecipientEmail($recipientEmail)
    {
        $this->recipientEmail = $recipientEmail;

        return $this;
    }

    /**
     * Get recipientEmail
     *
     * @return string 
     */
    public function getRecipientEmail()
    {
        return $this->recipientEmail;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Email
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set sentAt
     *
     * @param \DateTime $sentAt
     * @return Email
     */
    public function setSentAt($sentAt)
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    /**
     * Get sentAt
     *
     * @return \DateTime 
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }
}
