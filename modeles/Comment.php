<?php
/**
 * Comment entity specification
 */
class Comment
{
    /**
     * @var int
     */
    private $idComment;
    /**
     * @var string
     */
    private $content;
    /**
     * @var bool
     */
    private $validated;
    /**
     * @var string
     */
    private $creationTime;
    /**
     * @var int
     */
    private $idPost;
    /**
     * @var int
     */
    private $idUser;
    
    /**
     * Constructor
     * @param array $datas
     */
    public function __construct(array $datas)
    {
        $this->hydrate($datas);
    }
    
    /**
     * Getters
     */

    public function idComment()
    {
        return $this->idComment;
    }
    public function content()
    {
        return $this->content;
    }
    public function validated()
    {
        return $this->validated;
    }
    public function creationTime()
    {
        return $this->creationTime;
    }
    public function idPost()
    {
        return $this->idPost;
    }
    public function idUser()
    {
        return $this->idUser;
    }
    
    /**
     * Setters
     */

    public function setIdComment($id)
    {
        $this->idComment = $id;
    }
    public function setContent($content)
    {
        $this->content = $content;
    }
    public function setValidated($validated)
    {
        $this->validated = $validated;
    }
    public function setCreationTime($creationTime)
    {
        $this->creationTime = $creationTime;
    }
    public function setIdPost($idPost)
    {
        $this->idPost = $idPost;
    }
    public function setIdUser($idUser)
    {
        $this->idUser = $idUser;
    }
    
    /**
     * Fill each attribute of the entity with datas
     * @param array $datas
     */
    public function hydrate(array $datas)
    {
        foreach ($datas as $fieldName => $data) {
            $fieldNameParts = explode('_', $fieldName);
            $methodName = 'set';
            foreach ($fieldNameParts as $fieldNamePart) {
                $methodName .= ucfirst($fieldNamePart);
            }
            if (method_exists($this, $methodName)) {
                $this->$methodName($data);
            }
        }
    }
}
