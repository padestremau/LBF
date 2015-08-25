<?php

namespace LBF\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\ExecutionContextInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Recipe
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LBF\MainBundle\Entity\RecipeRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Recipe
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
     * @ORM\ManyToOne(targetEntity="LBF\MainBundle\Entity\Element", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $element;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var integer
     *
     * @ORM\Column(name="duration", type="integer", nullable=true)
     */
    private $duration;

    /**
     * @var integer
     *
     * @ORM\Column(name="forHowMany", type="integer", nullable=true)
     */
    private $forHowMany;

    /**
     * @var integer
     *
     * @ORM\Column(name="cooking", type="integer", nullable=true)
     */
    private $cooking;

    /**
     * @var string
     *
     * @ORM\Column(name="origin", type="string", length=255, nullable=true)
     */
    private $origin;

    /**
     * @var array
     *
     * @ORM\Column(name="ingredientsFr", type="array", nullable=true)
     */
    private $ingredientsFr;

    /**
     * @var array
     *
     * @ORM\Column(name="preparationFr", type="array", nullable=true)
     */
    private $preparationFr;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionFr", type="text", nullable=true)
     */
    private $descriptionFr;

    /**
     * @var array
     *
     * @ORM\Column(name="ingredientsEs", type="array")
     */
    private $ingredientsEs;

    /**
     * @var array
     *
     * @ORM\Column(name="preparationEs", type="array")
     */
    private $preparationEs;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionEs", type="text")
     */
    private $descriptionEs;

    /**
     * @var array
     *
     * @ORM\Column(name="ingredientsEn", type="array", nullable=true)
     */
    private $ingredientsEn;

    /**
     * @var array
     *
     * @ORM\Column(name="preparationEn", type="array", nullable=true)
     */
    private $preparationEn;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionEn", type="text", nullable=true)
     */
    private $descriptionEn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * @var string
     *
     * @ORM\Column(name="active", type="string", length=255, nullable=true)
     */
    private $active;

    /**
     * @var boolean
     *
     * @ORM\Column(name="taste", type="boolean", nullable=true)
     */
    private $taste;

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
        $this->createdAt        = new \Datetime;
        $this->updatedAt        = new \Datetime;
        $this->active           = "active";
        $this->taste            = true;
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
     * Set title
     *
     * @param string $title
     * @return Recipe
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set duration
     *
     * @param integer $duration
     * @return Recipe
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;

        return $this;
    }

    /**
     * Get duration
     *
     * @return integer 
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * Set forHowMany
     *
     * @param integer $forHowMany
     * @return Recipe
     */
    public function setForHowMany($forHowMany)
    {
        $this->forHowMany = $forHowMany;

        return $this;
    }

    /**
     * Get forHowMany
     *
     * @return integer 
     */
    public function getForHowMany()
    {
        return $this->forHowMany;
    }

    /**
     * Set cooking
     *
     * @param integer $cooking
     * @return Recipe
     */
    public function setCooking($cooking)
    {
        $this->cooking = $cooking;

        return $this;
    }

    /**
     * Get cooking
     *
     * @return integer 
     */
    public function getCooking()
    {
        return $this->cooking;
    }

    /**
     * Set origin
     *
     * @param string $origin
     * @return Recipe
     */
    public function setOrigin($origin)
    {
        $this->origin = $origin;

        return $this;
    }

    /**
     * Get origin
     *
     * @return string 
     */
    public function getOrigin()
    {
        return $this->origin;
    }

    /**
     * Set ingredients
     *
     * @param array $ingredients
     * @return Recipe
     */
    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;

        return $this;
    }

    /**
     * Get ingredients
     *
     * @return array 
     */
    public function getIngredients()
    {
        return $this->ingredients;
    }

    /**
     * Set preparation
     *
     * @param array $preparation
     * @return Recipe
     */
    public function setPreparation($preparation)
    {
        $this->preparation = $preparation;

        return $this;
    }

    /**
     * Get preparation
     *
     * @return array 
     */
    public function getPreparation()
    {
        return $this->preparation;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Recipe
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Recipe
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Recipe
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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
        return 'img/recipes';
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
     * Set element
     *
     * @param \LBF\MainBundle\Entity\Element $element
     * @return Recipe
     */
    public function setElement(\LBF\MainBundle\Entity\Element $element = null)
    {
        $this->element = $element;

        return $this;
    }

    /**
     * Get element
     *
     * @return \LBF\MainBundle\Entity\Element 
     */
    public function getElement()
    {
        return $this->element;
    }

    /**
     * Set active
     *
     * @param string $active
     * @return Recipe
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return string 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set ingredients_Ffr
     *
     * @param array $ingredientsFr
     * @return Recipe
     */
    public function setIngredientsFr($ingredientsFr)
    {
        $this->ingredientsFr = $ingredientsFr;

        return $this;
    }

    /**
     * Get ingredientsFr
     *
     * @return array 
     */
    public function getIngredientsFr()
    {
        return $this->ingredientsFr;
    }

    /**
     * Set preparationFr
     *
     * @param array $preparationFr
     * @return Recipe
     */
    public function setPreparationFr($preparationFr)
    {
        $this->preparationFr = $preparationFr;

        return $this;
    }

    /**
     * Get preparationFr
     *
     * @return array 
     */
    public function getPreparationFr()
    {
        return $this->preparationFr;
    }

    /**
     * Set descriptionFr
     *
     * @param string $descriptionFr
     * @return Recipe
     */
    public function setDescriptionFr($descriptionFr)
    {
        $this->descriptionFr = $descriptionFr;

        return $this;
    }

    /**
     * Get descriptionFr
     *
     * @return string 
     */
    public function getDescriptionFr()
    {
        return $this->descriptionFr;
    }

    /**
     * Set ingredients_Ees
     *
     * @param array $ingredientsEs
     * @return Recipe
     */
    public function setIngredientsEs($ingredientsEs)
    {
        $this->ingredientsEs = $ingredientsEs;

        return $this;
    }

    /**
     * Get ingredientsEs
     *
     * @return array 
     */
    public function getIngredientsEs()
    {
        return $this->ingredientsEs;
    }

    /**
     * Set preparationEs
     *
     * @param array $preparationEs
     * @return Recipe
     */
    public function setPreparationEs($preparationEs)
    {
        $this->preparationEs = $preparationEs;

        return $this;
    }

    /**
     * Get preparationEs
     *
     * @return array 
     */
    public function getPreparationEs()
    {
        return $this->preparationEs;
    }

    /**
     * Set descriptionEs
     *
     * @param string $descriptionEs
     * @return Recipe
     */
    public function setDescriptionEs($descriptionEs)
    {
        $this->descriptionEs = $descriptionEs;

        return $this;
    }

    /**
     * Get descriptionEs
     *
     * @return string 
     */
    public function getDescriptionEs()
    {
        return $this->descriptionEs;
    }

    /**
     * Set ingredientsEn
     *
     * @param array $ingredientsEn
     * @return Recipe
     */
    public function setIngredientsEn($ingredientsEn)
    {
        $this->ingredientsEn = $ingredientsEn;

        return $this;
    }

    /**
     * Get ingredientsEn
     *
     * @return array 
     */
    public function getIngredientsEn()
    {
        return $this->ingredientsEn;
    }

    /**
     * Set preparationEn
     *
     * @param array $preparationEn
     * @return Recipe
     */
    public function setPreparationEn($preparationEn)
    {
        $this->preparationEn = $preparationEn;

        return $this;
    }

    /**
     * Get preparationEn
     *
     * @return array 
     */
    public function getPreparationEn()
    {
        return $this->preparationEn;
    }

    /**
     * Set descriptionEn
     *
     * @param string $descriptionEn
     * @return Recipe
     */
    public function setDescriptionEn($descriptionEn)
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    /**
     * Get descriptionEn
     *
     * @return string 
     */
    public function getDescriptionEn()
    {
        return $this->descriptionEn;
    }

    /**
     * Set taste
     *
     * @param boolean $taste
     * @return Recipe
     */
    public function setTaste($taste)
    {
        $this->taste = $taste;

        return $this;
    }

    /**
     * Get taste
     *
     * @return boolean 
     */
    public function getTaste()
    {
        return $this->taste;
    }
}
