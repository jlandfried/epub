<?php


namespace ePub\Definition;


class Navigation
{
    public $src;

    /**
     * Array of Chapters
     *
     * @var array
     */
    public $chapters;


    public function __construct()
    {
        $this->src = new ManifestItem();
        $this->chapters = array();
    }

  /**
   * Recursively iterate through nested chapters to find all that have matching property.
   */
    public function findBy($property, $pattern, $chapters = NULL) {
      if (!$chapters) {
        $chapters = $this->chapters;
      }

      /** @var \ePub\Definition\Chapter; $chapter */
      foreach ($chapters as $chapter) {
        if (isset($chapter->{$property}) && preg_match('/' . $pattern . '/', $chapter->{$property})) {
          return $chapter;
        }
        else if ($chapter->children) {
          if ($result = $this->findBy($property, $pattern, $chapter->children)) {
            return $result;
          }
        }
      }
      return false;
    }
}
