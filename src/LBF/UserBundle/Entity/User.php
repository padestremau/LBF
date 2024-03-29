<?php

namespace LBF\UserBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LBF\UserBundle\Entity\UserRepository")
 * @ORM\HasLifecycleCallbacks
 * @UniqueEntity(fields="RUCnumber", message="userRegister.RUCnumber.already_used")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var boolean
     *
     * @ORM\Column(name="type", type="boolean")
     */
    protected $type;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255, nullable=true)
     */
    private $lastName;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="userRegister.companyName.not_blank", groups={"Registration", "Profile"})
     * @ORM\Column(name="companyName", type="string", length=255, nullable=true)
     */
    protected $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255, nullable=true)
     */
    private $tel;

    /**
     * @var string
     *
     * @ORM\Column(name="age", type="string", length=3, nullable=true)
     */
    private $age;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="userRegister.addressNumber.not_blank", groups={"Registration", "Profile"})
     * @ORM\Column(name="address_number", type="string", length=255, nullable=true)
     */
    protected $addressNumber;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="userRegister.addressStreet.not_blank", groups={"Registration", "Profile"})
     * @ORM\Column(name="address_street", type="string", length=255, nullable=true)
     */
    protected $addressStreet;

    /**
     * @var string
     *
     * @ORM\Column(name="address_postCode", type="string", length=255, nullable=true)
     */
    protected $addressPostCode;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="userRegister.addressCity.not_blank", groups={"Registration", "Profile"})
     * @ORM\Column(name="address_city", type="string", length=255, nullable=true)
     */
    protected $addressCity;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="userRegister.addressCountry.not_blank", groups={"Registration", "Profile"})
     * @ORM\Column(name="address_country", type="string", length=255, nullable=true)
     */
    protected $addressCountry;

    /**
     * @var string
     *
     * @Assert\NotBlank(message="userRegister.RUCnumber.not_blank", groups={"Registration", "Profile"})
     * @ORM\Column(name="RUCnumber", type="string", length=11, nullable=true)
     */
    protected $RUCnumber;

    /**
     * @var boolean
     *
     * @ORM\Column(name="gender", type="boolean", nullable=true)
     */
    private $gender;

    /**
     * @var string
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="alt", type="string", length=255, nullable=true)
     */
    private $alt;

    private $file;

    private $tempFilename;

    

    /*   *********      construct  *************  */

    public function __construct()
    {
        parent::__construct();
        $this->type = 1;
    }


    /*   *********     Setter and getter Functions  *************  */

    /**
     * @ORM\PreUpdate()
     * @ORM\PrePersist()
     */
    public function setUsernameToEmail()
    {
        $this->username = $this->email;
        $this->usernameCanonical = $this->emailCanonical;

        $this->setLastLogin(new \Datetime);

        if ($this->getType() == 1) {
            $this->setCompanyName('');
            $this->setAddressNumber('');
            $this->setAddressStreet('');
            $this->setAddressCity('');
            $this->setAddressPostCode('');
            $this->setAddressCountry('');
            $this->setRUCnumber('');
        }
    }


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
     * Set firstName
     *
     * @param string $firstName
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
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
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
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
     * Set tel
     *
     * @param string $tel
     * @return User
     */
    public function setTel($tel)
    {
        $this->tel = $tel;

        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set age
     *
     * @param string $age
     * @return User
     */
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get age
     *
     * @return string 
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set addressNumber
     *
     * @param string $addressNumber
     * @return User
     */
    public function setAddressNumber($addressNumber)
    {
        $this->addressNumber = $addressNumber;

        return $this;
    }

    /**
     * Get addressNumber
     *
     * @return string 
     */
    public function getAddressNumber()
    {
        return $this->addressNumber;
    }

    /**
     * Set addressStreet
     *
     * @param string $addressStreet
     * @return User
     */
    public function setAddressStreet($addressStreet)
    {
        $this->addressStreet = $addressStreet;

        return $this;
    }

    /**
     * Get addressStreet
     *
     * @return string 
     */
    public function getAddressStreet()
    {
        return $this->addressStreet;
    }

    /**
     * Set addressPostCode
     *
     * @param string $addressPostCode
     * @return User
     */
    public function setAddressPostCode($addressPostCode)
    {
        $this->addressPostCode = $addressPostCode;

        return $this;
    }

    /**
     * Get addressPostCode
     *
     * @return string 
     */
    public function getAddressPostCode()
    {
        return $this->addressPostCode;
    }

    /**
     * Set addressCity
     *
     * @param string $addressCity
     * @return User
     */
    public function setAddressCity($addressCity)
    {
        $this->addressCity = $addressCity;

        return $this;
    }

    /**
     * Get addressCity
     *
     * @return string 
     */
    public function getAddressCity()
    {
        return $this->addressCity;
    }

    /**
     * Set addressCountry
     *
     * @param string $addressCountry
     * @return User
     */
    public function setAddressCountry($addressCountry)
    {
        $this->addressCountry = $addressCountry;

        return $this;
    }

    /**
     * Get addressCountry
     *
     * @return string 
     */
    public function getAddressCountry()
    {
        return $this->addressCountry;
    }

    /**
     * Set gender
     *
     * @param boolean $gender
     * @return User
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return boolean 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /*   *********     File  *************  */

    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        // Si jamais il n'y a pas de fichier (champ facultatif)
        if (null === $this->file) {
          return;
        }

        // Le nom du fichier est son id, on doit juste stocker également son extension
        $this->url = $this->file->guessExtension();

        // Et on génère l'attribut 'alt' de la balise, à la valeur du nom du fichier sur le PC de l'internaute
        $this->alt = $this->file->getClientOriginalName();
    }

    /**
     * @ORM\PostPersist()
     * @ORM\PostUpdate()
     */
    public function upload()
    {
        // Si jamais il n'y a pas de fichier (champ facultatif)
        if (null === $this->file) {
          return;
        }

        // Si on avait un ancien fichier, on le supprime
        if (null !== $this->tempFilename) {
          $oldFile = $this->getUploadRootDir().'/'.$this->id.'.'.$this->tempFilename;
          if (file_exists($oldFile)) {
            unlink($oldFile);
          }
        }

        // On déplace le fichier envoyé dans le répertoire de notre choix
        $this->file->move(
          $this->getUploadRootDir(), // Le répertoire de destination
          $this->id.'.'.$this->url   // Le nom du fichier à créer, ici "id.extension"
        );
    }

    /**
     * @ORM\PreRemove()
     */
    public function preRemoveUpload()
    {
        // On sauvegarde temporairement le nom du fichier car il dépend de l'id
        $this->tempFilename = $this->getUploadRootDir().'/'.$this->id.'.'.$this->url;
    }

    /**
     * @ORM\PostRemove()
     */
    public function removeUpload()
    {
        // En PostRemove, on n'a pas accès à l'id, on utilise notre nom sauvegardé
        if (file_exists($this->tempFilename)) {
          // On supprime le fichier
          unlink($this->tempFilename);
        }
    }

    public function getUploadDir()
    {
        // On retourne le chemin relatif vers l'image pour un navigateur
        return 'img/profiles';
    }

    protected function getUploadRootDir()
    {
        // On retourne le chemin absolu vers l'image pour notre code PHP
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    public function getWebPath()
    {
        return $this->getUploadDir().'/'.$this->getId().'.'.$this->getUrl();
    }

    /**
     * @param string $url
     * @return Image
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param string $alt
     * @return Image
     */
    public function setAlt($alt)
    {
        $this->alt = $alt;
        return $this;
    }

    /**
     * @return string
     */
    public function getAlt()
    {
        return $this->alt;
    }

    public function setFile($file)
    {
        $this->file = $file;

        // On vérifie si on avait déjà un fichier pour cette entité
        if (null !== $this->url) {
          // On sauvegarde l'extension du fichier pour le supprimer plus tard
          $this->tempFilename = $this->url;

          // On réinitialise les valeurs des attributs url et alt
          $this->url = null;
          $this->alt = null;
        }
    }

    public function getFile()
    {
        return $this->file;
    }

    /*   *********   End  File  *************  */

    /**
     * Set companyName
     *
     * @param string $companyName
     * @return User
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string 
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set RUCnumber
     *
     * @param string $rUCnumber
     * @return User
     */
    public function setRUCnumber($rUCnumber)
    {
        $this->RUCnumber = $rUCnumber;

        return $this;
    }

    /**
     * Get RUCnumber
     *
     * @return string 
     */
    public function getRUCnumber()
    {
        return $this->RUCnumber;
    }

    /**
     * Set type
     *
     * @param boolean $type
     * @return User
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return boolean 
     */
    public function getType()
    {
        return $this->type;
    }
}
